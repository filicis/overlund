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

use App\Repository\MediaElementRepository;
use Doctrine\ORM\Mapping as ORM;


enum MediaRole: string
{
    case AUDIO        = 'Audio';
    case BOOK         = 'Book';
    case CARD         = 'Card';
    case ELECTRNIC    = 'Electronic';
    case FICHE        = 'Fiche';
    case FILM         = 'Film';
    case MAGAZINE     = 'Magazine';
    case MANUSCRIPT   = 'Manuscript';
    case MAP          = 'MAP';
    case NEWSPAPER    = 'Newspaper';
    case PHOTO        = 'Photo';
    case TOOMBSTONE   = 'Toombstrone';
    case VIDEO        = 'Video';
    case OTHER        = 'Other';
}


  /**
   *  class MediaElement
   *  - Implementerer FILE delen af Gedcom Multimedia Record v7.0
   *
   */

#[ORM\Entity(repositoryClass: MediaElementRepository::class)]
class MediaElement
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  /**
   *  format
   *
   */

  #[ORM\Column(length: 80)]
  private ?string $format = null;

  /**
   *  medium
   *
   */

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $medium = null;

  /**
   *  file
   *  - fil reference
   *
   */

  #[ORM\Column(length: 255)]
  private ?string $file = null;

  /**
   *  sortorder
   *
   */

  #[ORM\Column]
  private ?int $sortorder = 0;


  /**
   *  fileReference
   *
   */

  #[ORM\ManyToOne(inversedBy: 'mediaElements')]
  #[ORM\JoinColumn(nullable: false, onDelete: "Cascade")]
  private ?FileReference $fileReference = null;


  public function getId(): ?int
  {
    return $this->id;
  }

  public function getFormat(): ?string
  {
    return $this->format;
  }

  public function setFormat(string $format): self
  {
    $this->format = $format;

    return $this;
  }

  public function getMedium(): ?string
  {
    return $this->medium;
  }

  public function setMedium(?string $medium): self
  {
    $this->medium = $medium;

    return $this;
  }

  public function getFile(): ?string
  {
    return $this->file;
  }

  public function setFile(string $file): self
  {
    $this->file = $file;

    return $this;
  }

  public function getSortorder(): ?int
  {
    return $this->sortorder;
  }

  public function setSortorder(int $sortorder): self
  {
    $this->sortorder = $sortorder;

    return $this;
  }

  public function getFileReference(): ?FileReference
  {
    return $this->fileReference;
  }

  public function setFileReference(?FileReference $fileReference): self
  {
    $this->fileReference = $fileReference;

    return $this;
  }

}
