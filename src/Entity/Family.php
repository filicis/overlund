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



namespace App\Entity;

use App\Repository\FamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\RecordSuperclass;
use App\Entity\Relation;
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
  private ?Relation $husbandRelation = null;

  #[ORM\OneToOne(cascade: ['persist', 'remove'])]
  private ?Relation $wifeRelation = null;


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
   *  function getChildRelations()
   *
   *  - Returns alle the elements of collection releations for which 'role' == FamilyRole::CHIL
   *
   */

  public function getChildRelations(): Collection
  {
    return $this->relations->filter(function($element) { $element->isChild(); });
  }


  /**
   *
   *
   */

  public function getHusband(): ?Individual
  {
      return $this->husbandRelation != null ? $this->husbandRelation->getIndividual() : null;
  }



  /**
   *
   *
   */

  public function getHusbandRelation(): ?Relation
  {
      return $this->husbandRelation;
  }

  /**
   *
   *
   */

  public function setHusbandRelation(?Relation $husbandRelation): self
  {
      $this->husbandRelation = $husbandRelation;
      $this->husbandRelation->setRole(FamilyRole::HUSB);
      $this->addRelation($this->husbandRelation);

      return $this;
  }



  /**
   *
   *
   */

  public function getwife(): ?Individual
  {
      return $this->wifeRelation != null ? $this->wifeRelation->getIndividual() : null;
  }




  /**
   *
   *
   */

  public function getWifeRelation(): ?Relation
  {
      return $this->wifeRelation;
  }

  /**
   *
   *
   */

  public function setWifeRelation(?Relation $wifeRelation): self
  {
      $this->wifeRelation = $wifeRelation;
      $this->wifeRelation->setRole(FamilyRole::WIFE);
      $this->addRelation($this->wifeRelation);

      return $this;
  }




}
