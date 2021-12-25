<?php

namespace App\Entity;

use App\Repository\SourceCitationRepository;
use Doctrine\ORM\Mapping as ORM;

use       App\Entity\Traits\UlidIdTrait;

/**
 * @ORM\Entity(repositoryClass=SourceCitationRepository::class)
 */

#[ORM\Entity(repositoryClass: SourceCitationRepository::class)]
class SourceCitation
{
  use UlidIdTrait;


    /**
     * @ORM\ManyToOne(targetEntity=SourceRecord::class, inversedBy="sourceCitations")
     */

    #[ORM\ManyToOne(targetEntity: SourceRecord::class, inversedBy: "sourceCitations")]
    private $sourceRecord;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $page;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $quality;

    /**
     * @ORM\ManyToOne(targetEntity=Record::class, inversedBy="sourceCitations")
     */

    #[ORM\ManyToOne(targetEntity: Record::class, inversedBy: "sourceCitations")]
    private $record;


    public function getSourceRecord(): ?SourceRecord
    {
        return $this->sourceRecord;
    }

    public function setSourceRecord(?SourceRecord $sourceRecord): self
    {
        $this->sourceRecord = $sourceRecord;

        return $this;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function setPage(?string $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(?string $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getRecord(): ?Record
    {
        return $this->record;
    }

    public function setRecord(?Record $record): self
    {
        $this->record = $record;

        return $this;
    }
}
