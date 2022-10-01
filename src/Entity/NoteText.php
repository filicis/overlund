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

use       App\Repository\NoteTextRepository;
use       Doctrine\DBAL\Types\Types;
use       Doctrine\ORM\Mapping as ORM;

  /**
   *  class NoteText
   *
   */

#[ORM\Entity(repositoryClass: NoteTextRepository::class)]
class NoteText
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 80, nullable: true)]
  private ?string $mime = null;

  #[ORM\Column(length: 30, nullable: true)]
  private ?string $lang = null;

  #[ORM\Column(type: Types::TEXT)]
  private ?string $text = null;

  #[ORM\Column(nullable: true)]
  private ?int $sortorder = null;

  #[ORM\ManyToOne(inversedBy: 'noteTexts')]
  #[ORM\JoinColumn(onDelete: "Cascade")]
  private ?NoteStructure $noteStructure = null;


  //***************************************************************************
  //***************************************************************************
  //***************************************************************************


  public function getId(): ?int
  {
    return $this->id;
  }

  public function getMime(): ?string
  {
    return $this->mime;
  }

  public function setMime(?string $mime): self
  {
    $this->mime = $mime;

    return $this;
  }

  public function getLang(): ?string
  {
    return $this->lang;
  }

  public function setLang(?string $lang): self
  {
    $this->lang = $lang;

    return $this;
  }

  public function getText(): ?string
  {
    return $this->text;
  }

  public function setText(string $text): self
  {
    $this->text = $text;

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

  public function getNoteStructure(): ?NoteStructure
  {
    return $this->noteStructure;
  }

  public function setNoteStructure(?NoteStructure $noteStructure): self
  {
    $this->noteStructure = $noteStructure;

    return $this;
  }
}
