<?php

namespace App\Entity;

use App\Repository\SourceRecordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\RecordSuperclass;

/**
 * @ORM\Entity(repositoryClass=SourceRecordRepository::class)
 */
class SourceRecord extends RecordSuperclass
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $source;

    /**
     * @ORM\OneToMany(targetEntity=SourceCitation::class, mappedBy="sourceRecord")
     */
    private $sourceCitations;

    public function __construct()
    {
        $this->sourceCitations = new ArrayCollection();
    }


    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Collection|SourceCitation[]
     */
    public function getSourceCitations(): Collection
    {
        return $this->sourceCitations;
    }

    public function addSourceCitation(SourceCitation $sourceCitation): self
    {
        if (!$this->sourceCitations->contains($sourceCitation)) {
            $this->sourceCitations[] = $sourceCitation;
            $sourceCitation->setSourceRecord($this);
        }

        return $this;
    }

    public function removeSourceCitation(SourceCitation $sourceCitation): self
    {
        if ($this->sourceCitations->removeElement($sourceCitation)) {
            // set the owning side to null (unless already changed)
            if ($sourceCitation->getSourceRecord() === $this) {
                $sourceCitation->setSourceRecord(null);
            }
        }

        return $this;
    }
}
