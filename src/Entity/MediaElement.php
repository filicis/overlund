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
   *  - MediaType
   *
   */

  #[ORM\Column(length: 80)]
  private ?string $format = null;


  /**
   *  file
   *  - fil reference
   * 
   *  A URL with scheme ftp, http, or https refers to a web-accessible file.
   *  A URL with scheme file refers to a machine-local file as defined by RFC 8089.
   *  A URI reference with no scheme refers to a local file
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
