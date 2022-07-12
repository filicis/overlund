<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/


namespace App\Entity;

use App\Repository\FamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\RecordSuperclass;

  /**
   * @ORM\Entity(repositoryClass=FamilyRepository::class)
   **/

#[ORM\Entity(repositoryClass: FamilyRepository::class)]
class Family extends RecordSuperclass
{
  protected const XREF_PREFIX = 'F';

  /**
   * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="families")
   */

  #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "families")]
  private $project;

  #[ORM\OneToMany(mappedBy: 'family', targetEntity: Relation::class, orphanRemoval: true)]
  private $relations;

  public function __construct()
  {
      $this->relations = new ArrayCollection();
  }



  public function getProject(): ?Project
  {
      return $this->project;
  }

  public function setProject(?Project $project): self
  {
      $this->project = $project;

      return $this;
  }

  /**
   * @return Collection<int, Relation>
   */
  public function getRelations(): Collection
  {
      return $this->relations;
  }

  public function addRelation(Relation $relation): self
  {
      if (!$this->relations->contains($relation)) {
          $this->relations[] = $relation;
          $relation->setFamily($this);
      }

      return $this;
  }

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


}
