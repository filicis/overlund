<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Entity;

use App\Repository\FamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\RecordSuperclass;
use App\Entity\Traits\Restrictions;

  /**
   *  Implements Gedcom FAMILY_RECORD
   *
   *  @link https://gedcom.io/terms/v7/record-FAM
   *
   */

#[ORM\Entity(repositoryClass: FamilyRepository::class)]
class Family extends RecordSuperclass
{
  use Restrictions;
  
  protected const XREF_PREFIX = 'F';

  /**
   * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="families")
   */

  #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "families")]
  private $project;

  /**
   *  relation
   *
   *  - Association class between FAM and HUSB/WIFE/INDI
   *
   */

  #[ORM\OneToMany(mappedBy: 'family', targetEntity: Relation::class, indexBy: 'individual', orphanRemoval: true)]
  private $relations;

  #[ORM\OneToOne(cascade: ['persist', 'remove'])]
  private ?Relation $_husb = null;

  #[ORM\OneToOne(cascade: ['persist', 'remove'])]
  private ?Relation $_wife = null;


  // ********************************************
  // ********************************************
  // ********************************************

  public function __construct()
  {
      $this->relations = new ArrayCollection();
  }


  /**
   *  function getProject()
   */ 

  public function getProject(): ?Project
  {
      return $this->project;
  }


  /**
   *  function setProject()
   */

  public function setProject(?Project $project): self
  {
      $this->project = $project;

      return $this;
  }


  /**
   *  getRelations
   */

  public function getRelations(): Collection
  {
      return $this->relations;
  }


  /**
   *  function addRelation()
   */ 

  public function addRelation(Relation $relation): self
  {
      if (!$this->relations->contains($relation)) {
          $this->relations[] = $relation;
          $relation->setFamily($this);
      }
      return $this;
  }


  /**
   *  function removeRelation()
   */

  public function removeRelation(Relation $relation): self
  {
      if ($this->relations->removeElement($relation)) {
          // set the owning side to null (unless already changed)
          if ($relation->getFamily() === $this) {
              $relation->setFamily(null);
          }
      }
      return $this;
  }


  /**
   *  function getHusb()
   *
   */

  public function getHusb(): ?Individual
  {
      return $this->_husb != null ? $this->_husb->individual : null;
  }


  /**
   *  function setHusb()
   *
   */

  public function setHusb(?Relation $_husb): self
  {
      $this->_husb = $_husb;

      return $this;
  }


  /**
   *  function getWife()
   *
   */

  public function getWife(): ?Individual
  {
      return $this->_wife != null ? $this->_wife->individual : null;;
  }


  /**
   *  function setWife()
   *
   */

  public function setWife(?Relation $_wife): self
  {
      $this->_wife = $_wife;

      return $this;
  }


  /**
   *  function getChildren()
   *
   *  Returns alle the elements of collection releations for which 'role' == FamilyRole::CHIL
   *
   */

  public function getChildren(): Collection
  {
    return $this->relations->filter(function($element) { $element->role == FamilyRole::CHIL; });
  }




}
