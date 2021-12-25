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

use App\Repository\MediaRecordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediaRecordRepository::class)
 */

#[ORM\Entity(repositoryClass: MediaRecordRepository::class)]
class MediaRecord extends RecordSuperclass
{
  protected const XREF_PREFIX = 'M';

  /**
   * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="mediaRecords")
   */

  #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "mediaRecords")]
  private $project;

  /**
   * @ORM\OneToMany(targetEntity=MediaLink::class, mappedBy="mediaRecord")
   */

  #[ORM\OneToMany(targetEntity: MediaLink::class, mappedBy: "mediaRecord")]
  private $mediaLinks;

  public function __construct()
  {
      $this->mediaLinks = new ArrayCollection();
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
   * @return Collection|MediaLink[]
   */
  public function getMediaLinks(): Collection
  {
      return $this->mediaLinks;
  }

  public function addMediaLink(MediaLink $mediaLink): self
  {
      if (!$this->mediaLinks->contains($mediaLink)) {
          $this->mediaLinks[] = $mediaLink;
          $mediaLink->setMediaRecord($this);
      }

      return $this;
  }

  public function removeMediaLink(MediaLink $mediaLink): self
  {
      if ($this->mediaLinks->removeElement($mediaLink)) {
          // set the owning side to null (unless already changed)
          if ($mediaLink->getMediaRecord() === $this) {
              $mediaLink->setMediaRecord(null);
          }
      }

      return $this;
  }

}
