<?php

namespace App\Entity;

use       Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class NamePieces
{
    /*
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
      private ?int $id = null;
    */

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $npfx = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $givn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nick = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $spfx = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $surn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nsfx = null;

    /*
    public function getId(): ?int
    {
        return $this->id;
    }
     */

    public function getNpfx(): ?string
    {
        return $this->npfx;
    }

    public function setNpfx(?string $npfx): self
    {
        $this->npfx = $npfx;

        return $this;
    }

    public function getGivn(): ?string
    {
        return $this->givn;
    }

    public function setGivn(?string $givn): self
    {
        $this->givn = $givn;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(?string $nick): self
    {
        $this->nick = $nick;

        return $this;
    }

    public function getSpfx(): ?string
    {
        return $this->spfx;
    }

    public function setSpfx(?string $spfx): self
    {
        $this->spfx = $spfx;

        return $this;
    }

    public function getSurn(): ?string
    {
        return $this->surn;
    }

    public function setSurn(?string $surn): self
    {
        $this->surn = $surn;

        return $this;
    }

    public function getNsfx(): ?string
    {
        return $this->nsfx;
    }

    public function setNsfx(?string $nsfx): self
    {
        $this->nsfx = $nsfx;

        return $this;
    }
}
