<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/



namespace App\Entity\Traits;

use       Doctrine\ORM\Mapping as ORM;



  /**
   *  trait PersonalNamePieces
   *  - Gedcom 7.0
   *
   *  Anvendes i:
   *  - HeaderRecord
   *  - RepositoryRecord
   *  - SubmitterRecord
   *  - Event*
   *
   **/


trait PersonalNamePieces
{

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     **/

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $npfx;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     **/

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $givn;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     **/

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $nick;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     **/

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $spfx;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     **/

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $surn;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     **/

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $nsfx;


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

    public function setGivn(string $givn): self
    {
        $this->givn = $givn;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): self
    {
        $this->nick = $nick;

        return $this;
    }

    public function getSpfx(): ?string
    {
        return $this->spfx;
    }

    public function setSpfx(string $spfx): self
    {
        $this->spfx = $spfx;

        return $this;
    }

    public function getSurn(): ?string
    {
        return $this->surn;
    }

    public function setSurn(string $surn): self
    {
        $this->surn = $surn;

        return $this;
    }

    public function getNsfx(): ?string
    {
        return $this->nsfx;
    }

    public function setNsfx(string $nsfx): self
    {
        $this->nsfx = $nsfx;

        return $this;
    }

}
