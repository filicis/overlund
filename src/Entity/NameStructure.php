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
  private ?string $nameType = null;

  #[Assert\Type(type: NamePieces::class)]
  #[Assert\Valid]
  #[ORM\Embedded(class: NamePieces::class)]
  protected NamePieces $namePieces;

  #[ORM\ManyToOne(inversedBy: 'names')]
  private ?Individual $individual = null;

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

    public function getNamePieces() : NamePieces
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

    public function getNameType(): ?string
    {
        return $this->nameType;
    }

    public function setNameType(?string $nameType): self
    {
        $this->nameType = $nameType;

        return $this;
    }

    public function getIndividual(): ?Individual
    {
        return $this->individual;
    }

    public function setIndividual(?Individual $individual): self
    {
        $this->individual = $individual;

        return $this;
    }
}
