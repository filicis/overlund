<?php

namespace App\Entity;

use       App\Repository\IndiRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\GedcomStructure;

#[ORM\Entity(repositoryClass: IndiRepository::class)]
class Indi extends GedcomStructure
{
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $dummy;


    public function getDummy(): ?string
    {
        return $this->dummy;
    }

    public function setDummy(?string $dummy): self
    {
        $this->dummy = $dummy;

        return $this;
    }

}
