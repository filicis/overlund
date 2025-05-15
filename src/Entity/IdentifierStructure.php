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

 /**
  * Implementerer GEDCOM v7 IDENTIFIER_STRUCTURE
  */


namespace App\Entity;

use       App\Repository\IdentifierStructureRepository;
use       Doctrine\ORM\Mapping as ORM;
use       Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: IdentifierStructureRepository::class)]
class IdentifierStructure
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;


  /**
   *
   *  https://gedcom.io/terms/v7/REFN
   */

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $refn = null;


  /**
   *
   *  https://gedcom.io/terms/v7/UID
   *
   */

  #[ORM\Column(type: 'uuid', nullable: true)]
  private ?Uuid $uid = null;


  /**
   *
   *  https://gedcom.io/terms/v7/EXID
   */

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $exid = null;


  /**
   *
   *  https://gedcom.io/terms/v7/TYPE
   */

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $type = null;

  #[ORM\ManyToOne(inversedBy: 'identifierStructures')]
  #[ORM\JoinColumn(nullable: false, onDelete: "Cascade")]
  private ?IdentifierLink $identifierLink = null;


  //***************************************************************************
  //***************************************************************************
  //***************************************************************************

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getRefn(): ?string
  {
    return $this->refn;
  }

  public function setRefn(?string $refn): self
  {
    $this->refn = $refn;

    return $this;
  }

  public function getUid(): ?Uuid
  {
    return $this->uid;
  }

  public function setUid(?Uuid $uid): self
  {
    $this->uid = $uid;

    return $this;
  }

  public function getExid(): ?string
  {
    return $this->exid;
  }

  public function setExid(?string $exid): self
  {
    $this->exid = $exid;

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

  public function getIdentifierLink(): ?IdentifierLink
  {
      return $this->identifierLink;
  }

  public function setIdentifierLink(?IdentifierLink $identifierLink): self
  {
      $this->identifierLink = $identifierLink;

      return $this;
  }
}
