<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/


namespace	App\Entity;

//use       App\Entity\

use 			Doctrine\ORM\Mapping as ORM;
use 			Doctrine\ORM\Mapping\Index;
use       Doctrine\ORM\Event;
use       Doctrine\ORM\Event\PrePersistEventArgs;
use       Doctrine\ORM\Event\LifecycleEventArgs;
use       Doctrine\ORM\Mapping\Entity;
use       Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use       Doctrine\ORM\Mapping\PrePersist;
use       Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use       Symfony\Component\Uid\Ulid;

use Doctrine\Persistence\ManagerRegistry;

use       App\Entity\Traits\XrefTrait;


  /**
   *  class Record
   *	- Gedcom version 5.5 - 7.0
   *
   *	Mapped Superclass til alle TopLevel Records:
   *	- FamilyRecord
   *	- IndividualRecord
   *  - NoteRecord
   *  - ObjeRecord
   *  - RepositoryRecord
   *  - SourceRecord
   *  - SubmitterRecord
   *
   *
   * 	@ORM\MappedSuperclass(repositoryClass=RecordSuperclassRepository::class)
   *
   *	@ORM\HasLifecycleCallbacks
   *
   *	@ ORM\Index(columns: ["xref", ])
   *  @ ORM\Table(indexes={@Index=(name="xref_idx", columns={"xref"}, options={"Length": 20})} )
   *	@ ORM\Index(fields: ["xref"])
   **/

class RecordSuperclass
{
  const dummy= "SELECT xref FROM family where xref REGEXP 'F\d*' ORDER BY xref desc";
  protected const XREF_PREFIX = '_';

  use XrefTrait;


  /**
   * @ORM\Id
   * @ORM\Column(type="ulid", unique=true)
   * @ORM\GeneratedValue(strategy="CUSTOM")
   * @ORM\CustomIdGenerator(class=UlidGenerator::class)
  **/

  private $id;


  /**
  * @ORM\Column(type="string", length=12, nullable=true)
  */
  private $rin;


  /**
   * @ORM\Column(type="datetime_immutable", nullable=true)
   */
  private $lastChange;






  /**
   * @ORM\Column(type="string", length=20, nullable=true)
   **/

  private $crea;


  public function getId(): ?Ulid
  {
    return $this->id;
  }




  public function getRin(): ?string
  {
      return $this->rin;
  }

  public function setRin(?string $rin): self
  {
      $this->rin = $rin;

      return $this;
  }


  public function getLastChange(): ?\DateTimeImmutable
  {
      return $this->lastChange;
  }


  public function setLastChange(?\DateTimeImmutable $lastChange): self
  {
      $this->lastChange = $lastChange;

      return $this;
  }



  /**
   *  myfunction
   *  - sætter CreatedAt
   *  - sætter xref
   *
   *  @ORM\PrePersist
   **/


  public function myfunction(LifeCycleEventArgs $event )
  {
    $sql= 'SELECT SUBSTRING(`xref`, 2) FROM '
          . strtolower((new \ReflectionClass($this))->getShortName())
          . ' where xref REGEXP "^[[:alpha:]][[:digit:]]+" ORDER BY xref DESC LIMIT 1';

    $em= $event->getEntityManager();

    $conn= $em->getConnection();


    $res= $conn->fetchOne($sql);

    if ($res)
      $this->xref= $this::XREF_PREFIX . ++$res;
    else
      $this->xref= $this::XREF_PREFIX . 1;

      //$this->xref= (new \ReflectionClass($this))->getShortName();


    $this->crea= date('Y-m-d H:i:s');

  }


  /**
  *	function cb()
  *
  *	@ORM\PrePersist
  **/
/*
  public function callback() : void
  {

  }

  public function getIdentifierLink(): ?IdentifierLink
  {
      return $this->identifierLink;
  }

  public function setIdentifierLink(?IdentifierLink $identifierLink): self
  {
      $this->identifierLink = $identifierLink;

      return $this;
  }

  public function getChan(): ?string
  {
      return $this->chan;
  }

  public function setChan(?string $chan): self
  {
      $this->chan = $chan;

      return $this;
  }

  public function getCrea(): ?string
  {
      return $this->crea;
  }

  public function setCrea(?string $crea): self
  {
      $this->crea = $crea;

      return $this;
  }

/*
  public function getChannotes(): ?JoinNotes
  {
      return $this->channotes;
  }

  public function setChannotes(?JoinNotes $channotes): self
  {
      $this->channotes = $channotes;

      return $this;
  }

*/


}
