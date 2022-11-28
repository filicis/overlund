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

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'media', targetEntity: MediaLink::class, orphanRemoval: true)]
    private Collection $mediaLinks;

    public function __construct()
    {
        $this->mediaLinks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, MediaLink>
     */
    public function getMediaLinks(): Collection
    {
        return $this->mediaLinks;
    }

    public function addMediaLink(MediaLink $mediaLink): self
    {
        if (!$this->mediaLinks->contains($mediaLink)) {
            $this->mediaLinks->add($mediaLink);
            $mediaLink->setMedia($this);
        }

        return $this;
    }

    public function removeMediaLink(MediaLink $mediaLink): self
    {
        if ($this->mediaLinks->removeElement($mediaLink)) {
            // set the owning side to null (unless already changed)
            if ($mediaLink->getMedia() === $this) {
                $mediaLink->setMedia(null);
            }
        }

        return $this;
    }
}
