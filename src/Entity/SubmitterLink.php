<?php

namespace App\Entity;

use App\Repository\SubmitterLinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubmitterLinkRepository::class)]
class SubmitterLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'submitterLink', targetEntity: SubmitterStructure::class)]
    private Collection $submitterStructures;

    public function __construct()
    {
        $this->submitterStructures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, SubmitterStructure>
     */
    public function getSubmitterStructures(): Collection
    {
        return $this->submitterStructures;
    }

    public function addSubmitterStructure(SubmitterStructure $submitterStructure): self
    {
        if (!$this->submitterStructures->contains($submitterStructure)) {
            $this->submitterStructures->add($submitterStructure);
            $submitterStructure->setSubmitterLink($this);
        }

        return $this;
    }

    public function removeSubmitterStructure(SubmitterStructure $submitterStructure): self
    {
        if ($this->submitterStructures->removeElement($submitterStructure)) {
            // set the owning side to null (unless already changed)
            if ($submitterStructure->getSubmitterLink() === $this) {
                $submitterStructure->setSubmitterLink(null);
            }
        }

        return $this;
    }
}
