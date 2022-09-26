<?php

/**
 * This file is part of the Overlund package.
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2000-2022 Filicis Software
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait Restrictions
{
    #[ORM\Column(nullable: true)]
    private ?bool $locked = false;

    #[ORM\Column(nullable: true)]
    private ?bool $confidential = false;

    #[ORM\Column(nullable: true)]
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
