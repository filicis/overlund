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

use       App\Repository\NoteStructureRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteStructureRepository::class)]
class NoteStructure
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\OneToMany(mappedBy: 'noteStructure', targetEntity: NoteText::class)]
  private Collection $noteTexts;

  #[ORM\Column(nullable: true)]
  private ?int $sortorder = null;

  #[ORM\ManyToOne(inversedBy: 'noteStructures')]
  #[ORM\JoinColumn(onDelete: "Cascade")]
  private ?NoteElement $noteElement = null;

  //***************************************************************************
  //***************************************************************************
  //***************************************************************************


  public function __construct()
  {
    $this->noteTexts = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  /**
  * @return Collection<int, NoteText>
  */
  public function getNoteTexts(): Collection
  {
    return $this->noteTexts;
  }

  public function addNote(NoteText $note): self
  {
    if (!$this->noteTexts->contains($note)) {
      $this->noteTexts->add($note);
      $note->setNoteStructure($this);
    }

    return $this;
  }

  public function removeNote(NoteText $note): self
  {
    if ($this->noteTexts->removeElement($note)) {
      // set the owning side to null (unless already changed)
      if ($note->getNoteStructure() === $this) {
        $note->setNoteStructure(null);
      }
    }

    return $this;
  }

  public function getSortorder(): ?int
  {
    return $this->sortorder;
  }

  public function setSortorder(?int $sortorder): self
  {
    $this->sortorder = $sortorder;

    return $this;
  }

  public function getNoteElement(): ?NoteElement
  {
    return $this->noteElement;
  }

  public function setNoteElement(?NoteElement $noteElement): self
  {
    $this->noteElement = $noteElement;

    return $this;
  }
}
