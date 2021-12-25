<?php

namespace App\Entity;

use App\Repository\NoteRecordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;

/**
 * @ORM\Entity(repositoryClass=NoteRecordRepository::class)
 */

#[ORM\Entity(repositoryClass: NoteRecordRepository::class)]
class NoteRecord extends RecordSuperclass
{

    /**
     * @ORM\Column(type="text")
     */

    #[ORM\Column(type: "text")]
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity=Record::class, mappedBy="noteRecords")
     */

    #[ORM\ManyToMany(targetEntity: Record::class, mappedBy: "noteRecords")]
    private $records;

    public function __construct()
    {
        $this->records = new ArrayCollection();
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Record[]
     */
    public function getRecords(): Collection
    {
        return $this->records;
    }

    public function addRecord(Record $record): self
    {
        if (!$this->records->contains($record)) {
            $this->records[] = $record;
            $record->addNoteRecord($this);
        }

        return $this;
    }

    public function removeRecord(Record $record): self
    {
        if ($this->records->removeElement($record)) {
            $record->removeNoteRecord($this);
        }

        return $this;
    }
}
