<?php


/**
 * This file is part of the Overlund package.
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2000-2022 Filicis Software
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


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
//use       Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
//use       Symfony\Component\Uid\Ulid;

use       Doctrine\Persistence\ManagerRegistry;

use       App\Entity\Traits\UlidIdTrait;
use       App\Entity\Traits\XrefTrait;


  /**
   *  class RecordSuperClass
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
   *  - PlaceRecord
   *  - PlaceForm
   *
   **/

#[ORM\MappedSuperclass(repositoryClass: RecordSuperclassRepository::class)]
#[ORM\HasLifecycleCallbacks]
class RecordSuperclass
{
  const dummy= "SELECT xref FROM family where xref REGEXP 'F\d*' ORDER BY xref desc";
  protected const XREF_PREFIX = '_';

  use UlidIdTrait, XrefTrait;


  /**
   */

  #[ORM\Column(type: "datetime_immutable", nullable: true)]
  private $lastChange;


  /**
   **/

  #[ORM\Column(type: "string", length: 20, nullable: true)]
  private $crea;


  /**
   *  function __construct
   *
   */

  public function __construct()
  {
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
   **/

  #[ORM\PrePersist]
  public function myfunction(LifeCycleEventArgs $event )
  {
    $sql= 'SELECT SUBSTRING(`xref`, 2) FROM '
          . strtolower((new \ReflectionClass($this))->getShortName())
          . ' where (`project_id` in (\''
          . $this->getProject()->getId()
          . '\')) and (xref REGEXP ("^[[:alpha:]][[:digit:]]+$")) ORDER BY xref DESC';

    $sql= 'SELECT SUBSTRING(`xref`, 2) FROM '
          . strtolower((new \ReflectionClass($this))->getShortName())
          . ' where xref REGEXP "^[[:alpha:]][[:digit:]]+$" ORDER BY length(xref) desc, xref DESC';


    $em= $event->getEntityManager();

    $conn= $em->getConnection();


    $res= $conn->fetchOne($sql);

    if ($res)
      $this->xref= $this::XREF_PREFIX . ($res + 1);
    else
      $this->xref= $this::XREF_PREFIX . 1;

      //$this->xref= (new \ReflectionClass($this))->getShortName();


    $this->crea= date('Y-m-d H:i:s');
    // $this->crea= $this->getProject()->getId();

    $this->lastChange= new \DatetimeImmutable();

  }


  /**
   *  mymyfunction
   *  - sætter CreatedAt
   *  - sætter xref
   *
   **/


  #[ORM\PreUpdate]
  public function mymyfunction()
  {
    $this->lastChange= new \DatetimeImmutable();
  }
}
