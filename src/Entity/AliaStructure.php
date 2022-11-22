<?php

namespace App\Entity;

use App\Repository\AliaStructureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AliaStructureRepository::class)]
class AliaStructure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Individual $individual = null;

    #[ORM\Column(length: 255)]
    private ?string $phrase = null;

    #[ORM\ManyToOne(inversedBy: 'alia')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Individual $indi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndividual(): ?Individual
    {
        return $this->individual;
    }

    public function setIndividual(Individual $individual): self
    {
        $this->individual = $individual;

        return $this;
    }

    public function getPhrase(): ?string
    {
        return $this->phrase;
    }

    public function setPhrase(string $phrase): self
    {
        $this->phrase = $phrase;

        return $this;
    }

    public function getIndi(): ?Individual
    {
        return $this->indi;
    }

    public function setIndi(?Individual $indi): self
    {
        $this->indi = $indi;

        return $this;
    }
}
