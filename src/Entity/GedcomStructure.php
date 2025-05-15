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

use       App\Repository\GedcomRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\DBAL\Types\Types;
use       Doctrine\ORM\Mapping as ORM;

use       Symfony\Bridge\Doctrine\Types\UlidType;
use        Symfony\Component\Uid\Ulid;




  /**
   *
   *
   */

#[ORM\Entity(repositoryClass: GedcomStructureRepository::class)]
class GedcomStructure
{


  #[ORM\Id]
  #[ORM\Column(type: UlidType::NAME, unique: true)]
  #[ORM\GeneratedValue(strategy: "CUSTOM")]
  #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
  private $id;



  /**
   *  project
   *
   */

  #[ORM\ManyToOne(inversedBy: 'gedcomStructures')]
  #[ORM\JoinColumn(nullable: false)]
  private ?project $project = null;


  /**
   *  parent
   *
   */

  #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
  private ?self $parent = null;


  /**
   *  children
   *
   */

  #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
  private Collection $children;


  /**
   *  Gedcom
   */

  #[ORM\Column]
  private ?int $level = null;

  #[ORM\Column(length: 32, nullable: true)]
  private ?string $xref = null;

  #[ORM\Column(length: 32)]
  private ?string $tag = null;

  #[ORM\Column(length: 20, nullable: true)]
  private ?string $pointer = null;

  #[ORM\Column(length: 32, nullable: true)]
  private ?string $escape = null;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  private ?string $value = null;


  //******************************************************************************
  //******************************************************************************
  //******************************************************************************

  public function __construct()
  {
    $this->children = new ArrayCollection();
  }

  /**
   *  getId()
   *
   **/

  public function getId(): ?Ulid
  {
    return $this->id;
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

  public function getParent(): ?self
  {
    return $this->parent;
  }

  public function setParent(?self $parent): self
  {
    $this->parent = $parent;

    return $this;
  }

  /**
  * @return Collection<int, self>
  */
  public function getChildren(): Collection
  {
    return $this->children;
  }

  public function addChild(self $child): self
  {
    if (!$this->children->contains($child)) {
      $this->children->add($child);
      $child->setParent($this);
    }

    return $this;
  }

  public function removeChild(self $child): self
  {
    if ($this->children->removeElement($child)) {
      // set the owning side to null (unless already changed)
      if ($child->getParent() === $this) {
        $child->setParent(null);
      }
    }

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

  public function getEscape(): ?string
  {
      return $this->escape;
  }

  public function setEscape(?string $escape): self
  {
      $this->escape = $escape;

      return $this;
  }

  public function getValue(): ?string
  {
      return $this->value;
  }

  public function setValue(?string $value): self
  {
      $this->value = $value;

      return $this;
  }

  public function getProject(): ?Project
  {
      return $this->project;
  }

  public function setProject(Project $project): self
  {
      $this->project = $project;

      return $this;
  }
}
