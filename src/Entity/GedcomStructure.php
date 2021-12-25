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

use App\Repository\GedcomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use       App\Entity\Traits\UlidIdTrait;
use       App\Entity\GedcomStructure;


  /**
   * @ORM\Entity(repositoryClass=GedcomRepository::class)
   * @ORM\InheritanceType("SINGLE_TABLE")
   * @ORM\DiscriminatorColumn(name="discr", type="string")
   *
   **/

#[ORM\Entity(repositoryClass: GedcomRepository::class)]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string', length: 20)]
class GedcomStructure
{
  use UlidIdTrait;


  /**
   * @ORM\Column(type="integer", nullable=true)
   */

  #[ORM\Column(type: "integer", nullable: true)]
  private $line;

  /**
  * @ORM\Column(type="integer")
  */

  #[ORM\Column(type: "integer")]
  private $level;

  /**
  * @ORM\Column(type="string", length=20, nullable=true)
  */

  #[ORM\Column(type: "string", length: 20, nullable: true)]
  private $xref;

  /**
  * @ORM\Column(type="string", length=32)
  */

  #[ORM\Column(type: "string", length: 32)]
  private $tag;

  /**
  * @ORM\Column(type="string", length=20, nullable=true)
  */

  #[ORM\Column(type: "string", length: 20, nullable: true)]
  private $pointer;

  /**
  * @ORM\Column(type="string", length=255)
  */

  #[ORM\Column(type: "string", length: 255)]
  private $value;

  /**
  * @ORM\ManyToOne(targetEntity=GedcomStructure::class, inversedBy="subStructures")
  */

  #[ORM\ManyToOne(targetEntity: GedcomStructure::class, inversedBy: "subStructures")]
  private $superStructure;

  /**
  * @ORM\OneToMany(targetEntity=GedcomStructure::class, mappedBy="superStructure")
  */

  #[ORM\OneToMany(targetEntity: GedcomStructure::class, mappedBy: "superStructure")]
  private $subStructures;

  /**
  * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="gedcomStructures")
  * @ORM\JoinColumn(nullable=false)
  */

  #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "gedcomStructures")]
  #[ORM\JoinColumn(nullable: false)]
  private $project;

  /**
  * @ORM\Column(type="string", length=20)
  */


  public function __construct()
  {
    $this->subStructures = new ArrayCollection();
  }

  public function getLine(): ?int
  {
    return $this->line;
  }

  public function setLine(?int $line): self
  {
    $this->line = $line;

    return $this;
  }

  public function getLevel(): ?int
  {
    return $this->level;
  }

  public function setLevel(int $level): self
  {
    $this->level = $level;

    return $this;
  }

  public function getXref(): ?string
  {
    return $this->xref;
  }

  public function setXref(?string $xref): self
  {
    $this->xref = $xref;

    return $this;
  }

  public function getTag(): ?string
  {
    return $this->tag;
  }

  public function setTag(string $tag): self
  {
    $this->tag = $tag;

    return $this;
  }

  public function getPointer(): ?string
  {
    return $this->pointer;
  }

  public function setPointer(?string $pointer): self
  {
    $this->pointer = $pointer;

    return $this;
  }

  public function getValue(): ?string
  {
    return $this->value;
  }

  public function setValue(string $value): self
  {
    $this->value = $value;

    return $this;
  }

  public function getSuperStructure(): ?self
  {
    return $this->superStructure;
  }

  public function setSuperStructure(?self $superStructure): self
  {
    $this->superStructure = $superStructure;

    return $this;
  }

  /**
  * @return Collection|self[]
  */
  public function getSubStructures(): Collection
  {
    return $this->subStructures;
  }

  public function addSubStructure(self $subStructure): self
  {
    if (!$this->subStructures->contains($subStructure)) {
      $this->subStructures[] = $subStructure;
      $subStructure->setSuperStructure($this);
    }

    return $this;
  }

  public function removeSubStructure(self $subStructure): self
  {
    if ($this->subStructures->removeElement($subStructure)) {
      // set the owning side to null (unless already changed)
      if ($subStructure->getSuperStructure() === $this) {
        $subStructure->setSuperStructure(null);
      }
    }

    return $this;
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

  public function getDiscr(): ?string
  {
    return $this->discr;
  }

  public function setDiscr(string $discr): self
  {
    $this->discr = $discr;

    return $this;
  }
}
