<?php

namespace App\Entity;

use App\Repository\AssociationStructureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssociationStructureRepository::class)]
class AssociationStructure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Individual $individual = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phrase = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $role = null;

    #[ORM\ManyToOne(inversedBy: 'associationStructures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AssociationLink $associationLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndividual(): ?Individual
    {
        return $this->individual;
    }

    public function setIndividual(?Individual $individual): self
    {
        $this->individual = $individual;

        return $this;
    }

    public function getPhrase(): ?string
    {
        return $this->phrase;
    }

    public function setPhrase(?string $phrase): self
    {
        $this->phrase = $phrase;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAssociationLink(): ?AssociationLink
    {
        return $this->associationLink;
    }

    public function setAssociationLink(?AssociationLink $associationLink): self
    {
        $this->associationLink = $associationLink;

        return $this;
    }
}
