<?php

namespace App\Entity;

use App\Repository\AssociationLinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssociationLinkRepository::class)]
class AssociationLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'associationLink', targetEntity: AssociationStructure::class)]
    private Collection $associationStructures;

    public function __construct()
    {
        $this->associationStructures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, AssociationStructure>
     */
    public function getAssociationStructures(): Collection
    {
        return $this->associationStructures;
    }

    public function addAssociationStructure(AssociationStructure $associationStructure): self
    {
        if (!$this->associationStructures->contains($associationStructure)) {
            $this->associationStructures->add($associationStructure);
            $associationStructure->setAssociationLink($this);
        }

        return $this;
    }

    public function removeAssociationStructure(AssociationStructure $associationStructure): self
    {
        if ($this->associationStructures->removeElement($associationStructure)) {
            // set the owning side to null (unless already changed)
            if ($associationStructure->getAssociationLink() === $this) {
                $associationStructure->setAssociationLink(null);
            }
        }

        return $this;
    }
}
