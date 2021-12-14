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

use 			Doctrine\ORM\Mapping as ORM;
use 			Doctrine\ORM\Mapping\Index;
use       Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use       Symfony\Component\Uid\Ulid;

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
   * 	@ORM\MappedSuperclass
   *
   *	@ORM\HasLifecycleCallbacks()
   *
   *	@ ORM\Index(columns: ["xref", ])
   *  @ ORM\Table(indexes={@Index=(name="xref_idx", columns={"xref"}, options={"Length": 20})} )
   *	@ ORM\Index(fields: ["xref"])
   **/

class RecordSuperclass
{
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

  public function myfunction(PreUpdateEventArgs $event)
  {
    if (! $event->hasChangedField('lastChange'))
    {
      $this->lastChange= new \DateTimeImmutable();
    }
    if (! $event->hasChangedField('xref'))
    {
      $this->xref= 'Void';
    }

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
