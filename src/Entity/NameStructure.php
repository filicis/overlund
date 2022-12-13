<?php

namespace App\Entity;

use       App\Repository\NameStructureRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\NamePieces;

#[ORM\Entity(repositoryClass: NameStructureRepository::class)]
class NameStructure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $personalName = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $type = null;


    #[ORM\Embedded(class: NamePieces::class)]
    private NamePieces namePieces;

    /**
     *  function __construct()
     */  

    public function __construct()
    {
      $this->namePieces= new NamePieces();
    }  

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     *  function getNamePieces()
     *
     */

    public getNamePieces() : NamePieces
    {
      return $this->namePieces;
    }  

    public function getPersonalName(): ?string
    {
        return $this->personalName;
    }

    public function setPersonalName(?string $personalName): self
    {
        $this->personalName = $personalName;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
