<?php

namespace App\Entity;

use App\Repository\SourceRecordRepository;
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


    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }
}
