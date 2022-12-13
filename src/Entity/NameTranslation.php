<?php

namespace App\Entity;

use       App\Repository\NameTranslationRepository;
use       Doctrine\ORM\Mapping as ORM;
use       App\Entity\NamePieces;

#[ORM\Entity(repositoryClass: NameTranslationRepository::class)]
class NameTranslation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $personalName = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $language = null;

    #[ORM\Emdedded(class: NamePieces::class)]
    private NamePieces $namePieces;

    public function __construct()
    {
      $this->namePieces= new NamePieces();
    }  

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }
}
