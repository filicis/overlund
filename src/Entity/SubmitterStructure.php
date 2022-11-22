<?php

namespace App\Entity;

use App\Repository\SubmitterStructureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubmitterStructureRepository::class)]
class SubmitterStructure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubmitterRecord $submitterRecord = null;

    #[ORM\ManyToOne(inversedBy: 'submitterStructures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubmitterLink $submitterLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubmitterRecord(): ?SubmitterRecord
    {
        return $this->submitterRecord;
    }

    public function setSubmitterRecord(SubmitterRecord $submitterRecord): self
    {
        $this->submitterRecord = $submitterRecord;

        return $this;
    }

    public function getSubmitterLink(): ?SubmitterLink
    {
        return $this->submitterLink;
    }

    public function setSubmitterLink(?SubmitterLink $submitterLink): self
    {
        $this->submitterLink = $submitterLink;

        return $this;
    }
}
