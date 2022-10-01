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

use       App\Repository\NoteElementRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;


  /**
   *
   *
   *
   */

#[ORM\Entity(repositoryClass: NoteElementRepository::class)]
class NoteElement
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\OneToMany(mappedBy: 'noteElement', targetEntity: NoteStructure::class)]
  private Collection $noteStructures;

  //***************************************************************************
  //***************************************************************************
  //***************************************************************************


  public function __construct()
  {
    $this->noteStructures = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * @return Collection<int, NoteStructure>
   */

  public function getNoteStructures(): Collection
  {
    return $this->noteStructures;
  }



  public function addNote(NoteStructure $note): self
  {
    if (!$this->noteStructures->contains($note)) {
      $this->noteStructures->add($note);
      $note->setNoteElement($this);
    }

    return $this;
  }

  public function removeNote(NoteStructure $note): self
  {
    if ($this->noteStructures->removeElement($note)) {
      // set the owning side to null (unless already changed)
      if ($note->getNoteElement() === $this) {
        $note->setNoteElement(null);
      }
    }

    return $this;
  }
}
