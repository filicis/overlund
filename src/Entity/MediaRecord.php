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

use       App\Repository\MediaRecordRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\Traits\Restrictions;

/**
 *  class MediaRecord
 *
 *  Implementerer Gedcom V7 Multimedia Record
 */

#[ORM\Entity(repositoryClass: MediaRecordRepository::class)]
class MediaRecord extends RecordSuperclass
{
  use Restrictions;

  protected const XREF_PREFIX = 'M';

  /**
   */

  #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "mediaRecords")]
  #[ORM\JoinColumn(onDelete: "Cascade")]
  private $project;

  /**
   *
   *
   */

  #[ORM\OneToMany(mappedBy: 'mediaRecord', targetEntity: FileReference::class)]
  private Collection $fileReferences;


  public function __construct()
  {
      $this->fileReferences = new ArrayCollection();
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
   * @return Collection<int, FileReference>
   */
  public function getFileReferences(): Collection
  {
      return $this->fileReferences;
  }

  public function addFileReference(FileReference $fileReference): self
  {
      if (!$this->fileReferences->contains($fileReference)) {
          $this->fileReferences->add($fileReference);
          $fileReference->setMediaRecord($this);
      }

      return $this;
  }

  public function removeFileReference(FileReference $fileReference): self
  {
      if ($this->fileReferences->removeElement($fileReference)) {
          // set the owning side to null (unless already changed)
          if ($fileReference->getMediaRecord() === $this) {
              $fileReference->setMediaRecord(null);
          }
      }

      return $this;
  }


}
