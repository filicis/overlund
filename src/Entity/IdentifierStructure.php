<?php

namespace App\Entity;

use App\Repository\IdentifierStructureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IdentifierStructureRepository::class)
 */
class IdentifierStructure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tag;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Record::class, inversedBy="indentifierStructure")
     */
    private $recordLinks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
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

    public function getRecord(): ?Record
    {
        return $this->recordLinks;
    }

    public function setRecord(?Record $recordLinks): self
    {
        $this->recordLinks = $recordLinks;

        return $this;
    }
}
