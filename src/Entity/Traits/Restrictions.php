<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait Restrictions
{
    #[ORM\Column]
    private ?bool $locked = null;

    #[ORM\Column]
    private ?bool $confidential = null;

    #[ORM\Column]
    private ?bool $privacy = null;


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
