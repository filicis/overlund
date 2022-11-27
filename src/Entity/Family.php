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

use       App\Repository\FamilyRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\Individual;
use       App\Entity\RecordSuperclass;
use       App\Entity\Relation;

use       App\Entity\Traits\IdentifierTrait;
use       App\Entity\Traits\MediaTrait;
use       App\Entity\Traits\Restrictions;

use       App\Entity\Media;



  /**
   *  Family
   *  Implementerer Gedcom FAMILY_RECORD
   *
   *  @link https://gedcom.io/terms/v7/record-FAM
   *
   */

#[ORM\Entity(repositoryClass: FamilyRepository::class)]
class Family extends RecordSuperclass
{
  use IdentifierTrait, Restrictions, MediaTrait;

  protected const XREF_PREFIX = 'F';

  /**
   *
   */

  #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "families")]
  private $project;

  /**
   *  relation
   *
   *  - Association class between FAM and HUSB/WIFE/INDI
   *
   */

  #[ORM\OneToMany(mappedBy: 'family', targetEntity: Relation::class, indexBy: 'individual', cascade: ["persist"], orphanRemoval: true)]
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
      $this->media= new Media();
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



  /**
   *  function addChild()
   *
   */

  public function addChild(Individual $child)
  {
    $relation= new Relation();
    $relation->setFamily($this);
    $reletion->setIndividual($child);
    return $this->addRelation($relation);
  }



  /**
   *  function setHusband()
   *
   */

  public function setHusband(Individual $husband)
  {
    $relation= new Relation();
    $relation->setFamily($this);
    $reletion->setIndividual($husband);
    return $this->setHusbandRelation($relation);
  }

  /**
   *  function setWife()
   *
   */

  public function setWife(Individual $wife)
  {
    $relation= new Relation();
    $relation->setFamily($this);
    $reletion->setIndividual($wife);
    return $this->setWifeRelation($relation);
  }


  /**
   *  function individualExits()
   *
   *  Checker om en given id allerede findes i 'relations' kollektionen
   */

  public function individualExits(ulid $id) : bool
  {
    return $id ? array_key_exits($id, $this->getRelations())  : false;
  }

}
