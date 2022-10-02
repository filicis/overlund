<?php

namespace App\Entity;

use App\Repository\FileReferenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileReferenceRepository::class)]
class FileReference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'fileReference', targetEntity: MediaElement::class, orphanRemoval: true)]
    private Collection $mediaElements;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'fileReferences')]
    private ?MediaRecord $mediaRecord = null;

    public function __construct()
    {
        $this->mediaElements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, MediaElement>
     */
    public function getMediaElements(): Collection
    {
        return $this->mediaElements;
    }

    public function addMediaElement(MediaElement $mediaElement): self
    {
        if (!$this->mediaElements->contains($mediaElement)) {
            $this->mediaElements->add($mediaElement);
            $mediaElement->setFileReference($this);
        }

        return $this;
    }

    public function removeMediaElement(MediaElement $mediaElement): self
    {
        if ($this->mediaElements->removeElement($mediaElement)) {
            // set the owning side to null (unless already changed)
            if ($mediaElement->getFileReference() === $this) {
                $mediaElement->setFileReference(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMediaRecord(): ?MediaRecord
    {
        return $this->mediaRecord;
    }

    public function setMediaRecord(?MediaRecord $mediaRecord): self
    {
        $this->mediaRecord = $mediaRecord;

        return $this;
    }
}
