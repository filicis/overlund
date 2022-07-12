<?php

namespace App\Entity;

use App\Repository\RelationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationRepository::class)]
class Relation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 4)]
    private $type;

    #[ORM\Column(type: 'string', length: 16, nullable: true)]
    private $pedi;

    #[ORM\Column(type: 'string', length: 16, nullable: true)]
    private $stat;

    #[ORM\ManyToOne(targetEntity: Individual::class, inversedBy: 'relations')]
    private $individual;

    #[ORM\ManyToOne(targetEntity: Family::class, inversedBy: 'relations')]
    #[ORM\JoinColumn(nullable: false)]
    private $family;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPedi(): ?string
    {
        return $this->pedi;
    }

    public function setPedi(?string $pedi): self
    {
        $this->pedi = $pedi;

        return $this;
    }

    public function getStat(): ?string
    {
        return $this->stat;
    }

    public function setStat(?string $stat): self
    {
        $this->stat = $stat;

        return $this;
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

    public function getFamily(): ?Family
    {
        return $this->family;
    }

    public function setFamily(?Family $family): self
    {
        $this->family = $family;

        return $this;
    }
}
