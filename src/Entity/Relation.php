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



namespace App\Entity;

use       App\Repository\RelationRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\Individual;
use       App\Entity\Family;

/**
 *  TODO:
 */

enum FamilyRole: string
{
    case CHIL = 'C';
    case HUSB = 'H';
    case WIFE = 'W';
}



/**
 *  class Relation
 *
 *  Association class between FAM and HUSB / WIFE /INDI
 * Gedcom FAMC, FAMS, HUSB, WIFE, CHIL
 */

#[ORM\Entity(repositoryClass: RelationRepository::class)]
class Relation
{

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;


  /**
   *  familyRole
   *  - Defines The individual's role in the current family
   */

  #[ORM\Column(type: 'string', enumType: FamilyRole::class)]
  private $role;

  /**
   *  pedi
   *  - Implements
   */

  #[ORM\Column(type: 'string', length: 16, nullable: true)]
  private $pedi;

  /**
   *
   *
   */

  #[ORM\Column(type: 'string', length: 16, nullable: true)]
  private $stat;

  /**
   *  TODO: Skal tilfølges link til NOTE_STRUCTURE
   *
   */

  /**
   *  individual
   *
   *
   */

  #[ORM\ManyToOne(targetEntity: Individual::class, inversedBy: 'relations')]
  #[OrderBy(["csortorder" => "ASC"])]
  #[ORM\JoinColumn(onDelete: "Cascade")]
  private $individual;

  /**
   *  family
   *
   */

  #[ORM\ManyToOne(targetEntity: Family::class, inversedBy: 'relations')]
  #[OrderBy(["fsortorder" => "ASC"])]
  #[ORM\JoinColumn(nullable: false, onDelete: "Cascade")]
  private $family;

  #[ORM\Column(nullable: true)]
  private ?int $fsortorder = null;

  #[ORM\Column(nullable: true)]
  private ?int $csortorder = null;


  // ********************************************
  // ********************************************
  // ********************************************


  public function __construct()
  {
    $this->role= FamilyRole::CHIL;
  }



  public function getId(): ?int
  {
    return $this->id;
  }


  /**
   *
   *  @return string Indicates the type of this relation, eg Husband, Wife, Child
   */

  public function getType(): ?string
  {
    return $this->type;
  }

  public function setType(string $type): self
  {
    $this->type = $type;

    return $this;
  }

  public function getPedi(): ?string
  {
    return $this->pedi;
  }

  public function setPedi(?string $pedi): self
  {
    $this->pedi = $pedi;

    return $this;
  }

  public function getStat(): ?string
  {
    return $this->stat;
  }

  public function setStat(?string $stat): self
  {
    $this->stat = $stat;

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

  public function getFamily(): ?Family
  {
    return $this->family;
  }

  public function setFamily(?Family $family): self
  {
    $this->family = $family;

    return $this;
  }

  public function getPhrase(): ?string
  {
      return $this->phrase;
  }

  public function setPhrase(?string $phrase): self
  {
      $this->phrase = $phrase;

      return $this;
  }


  public function isChild() : bool
  {
    return $this->role == FamilyRole::CHIL;
  }

  public function getFsortorder(): ?int
  {
      return $this->fsortorder;
  }

  public function setFsortorder(?int $fsortorder): self
  {
      $this->fsortorder = $fsortorder;

      return $this;
  }

  public function getCsortorder(): ?int
  {
      return $this->csortorder;
  }

  public function setCsortorder(?int $csortorder): self
  {
      $this->csortorder = $csortorder;

      return $this;
  }
}
