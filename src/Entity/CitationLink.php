<?php

namespace App\Entity;

use App\Repository\CitationLinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitationLinkRepository::class)]
class CitationLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'citationLink', targetEntity: CitationStructure::class)]
    private Collection $citationStructures;

    public function __construct()
    {
        $this->citationStructures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, CitationStructure>
     */
    public function getCitationStructures(): Collection
    {
        return $this->citationStructures;
    }

    public function addCitationStructure(CitationStructure $citationStructure): self
    {
        if (!$this->citationStructures->contains($citationStructure)) {
            $this->citationStructures->add($citationStructure);
            $citationStructure->setCitationLink($this);
        }

        return $this;
    }

    public function removeCitationStructure(CitationStructure $citationStructure): self
    {
        if ($this->citationStructures->removeElement($citationStructure)) {
            // set the owning side to null (unless already changed)
            if ($citationStructure->getCitationLink() === $this) {
                $citationStructure->setCitationLink(null);
            }
        }

        return $this;
    }
}
