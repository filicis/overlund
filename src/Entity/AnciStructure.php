<?php

namespace App\Entity;

use App\Repository\AnciStructureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnciStructureRepository::class)]
class AnciStructure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?SubmitterRecord $submitterRecord = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubmitterRecord(): ?SubmitterRecord
    {
        return $this->submitterRecord;
    }

    public function setSubmitterRecord(?SubmitterRecord $submitterRecord): self
    {
        $this->submitterRecord = $submitterRecord;

        return $this;
    }
}
