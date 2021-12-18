<?php

namespace App\Entity;

use App\Repository\NoteRecordRepository;
use Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;

/**
 * @ORM\Entity(repositoryClass=NoteRecordRepository::class)
 */
class NoteRecord extends RecordSuperclass
{

    /**
     * @ORM\Column(type="text")
     */
    private $note;

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
