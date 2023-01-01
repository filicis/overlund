<?php

namespace App\Entity;

//use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Restriction
{
    #[ORM\Column]
    private ?bool $locked = false;

    #[ORM\Column]
    private ?bool $confidential = false;

    #[ORM\Column]
    private ?bool $privacy = false;

    public function isLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): self
    {
        $this->locked = $locked;

        return $this;
    }

    public function isConfidential(): ?bool
    {
        return $this->confidential;
    }

    public function setConfidential(bool $confidential): self
    {
        $this->confidential = $confidential;

        return $this;
    }

    public function isPrivacy(): ?bool
    {
        return $this->privacy;
    }

    public function setPrivacy(bool $privacy): self
    {
        $this->privacy = $privacy;

        return $this;
    }
}
