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
*      - function personalName() der henter individdets fulde navn
*      - function media() der henter billeder af individdet, formentlig som en Collection
*      - function xxxx() der henter individdets fødsels- og dødsår
*/

enum FamilyRole: string {
    case CHIL = 'C';
    case HUSB = 'H';
    case WIFE = 'W';
}

/**
*  class Relation
*  - Forenings klasse mellem Family og Individual der implementerer Gedcom FAMC, FAMS, HUSB, WIFE, CHIL
*
*/

#[ ORM\Entity( repositoryClass: RelationRepository::class ) ]

class Relation {

    #[ ORM\Id ]
    #[ ORM\GeneratedValue ]
    #[ ORM\Column( type: 'integer' ) ]
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
     *  family
     */

  #[ORM\ManyToOne(targetEntity: "Family", inversedBy: 'chil', fetch: 'LAZY' ) ]
  #[ ORM\JoinColumn(name: 'family_id', referencedColumnName: 'id', nullable: false, onDelete: 'Cascade' ) ]
  private ?Family $family = null;
    

  /**
   *  individual
   *
   *
   */

  #[ORM\ManyToOne(targetEntity: Individual::class, inversedBy: 'fams', fetch: 'LAZY' ) ]
  #[ OrderBy( [ 'csortorder' => 'ASC' ] ) ]
  #[ ORM\JoinColumn(name: 'individual_id', referencedColumnName: 'id', nullable: true, onDelete: 'Cascade' ) ]
    private $individual;

    /**
    *  family_id1
    *  - Virtuel kolonne der spejler family_id
    */

  #[ Column( type: 'binary', name: 'family_id', insertable: false, updatable: false ) ]
  public $family_id1;

    /**
    *  family_id2
    *  - Virtuel kolonne der spejler family_id
    */

  #[ Column( type: 'binary', name: 'family_id', insertable: false, updatable: false ) ]
    public $family_id2;

    #[ ORM\Column( nullable: true ) ]
    private ?int $fsortorder = null;

    #[ ORM\Column( nullable: true ) ]
    private ?int $csortorder = null;

    // ********************************************
    // ********************************************
    // ********************************************

    public function __construct() {
        $this->role = FamilyRole::CHIL;
    }

    public function getId(): ?int {
        return $this->id;
    }

    /**
    *
    *  @return string Indicates the type of this relation, eg Husband, Wife, Child
    */

    public function getType(): ?string {
        return $this->type;
    }

    public function setType( string $type ): self {
        $this->type = $type;

        return $this;
    }

    public function getPedi(): ?string {
        return $this->pedi;
    }

    public function setPedi( ?string $pedi ): self {
        $this->pedi = $pedi;

        return $this;
    }

    public function getStat(): ?string {
        return $this->stat;
    }

    public function setStat( ?string $stat ): self {
        $this->stat = $stat;

        return $this;
    }

    public function getIndividual(): ?Individual {
        return $this->individual;
    }

    public function setIndividual( ?Individual $individual ): self {
        $this->individual = $individual;

        return $this;
    }

    public function getPhrase(): ?string {
        return $this->phrase;
    }

    public function setPhrase( ?string $phrase ): self {
        $this->phrase = $phrase;

        return $this;
    }

    public function isChild() : bool {
        return $this->role == FamilyRole::CHIL;
    }

    public function getFsortorder(): ?int {
        return $this->fsortorder;
    }

    public function setFsortorder( ?int $fsortorder ): self {
        $this->fsortorder = $fsortorder;

        return $this;
    }

    public function getCsortorder(): ?int {
        return $this->csortorder;
    }

    public function setCsortorder( ?int $csortorder ): self {
        $this->csortorder = $csortorder;

        return $this;
    }

    public function getFamily(): ?Family {
        return $this->family;
    }

    public function setFamily( ?Family $family ): self {
        $this->family = $family;

        return $this;
    }

    public function getFamilyId1(): ?Family {
        return $this->family_id1;
    }

    public function setFamilyId1( ?Family $family_id1 ): self {
        // unset the owning side of the relation if necessary
        if ( $family_id1 === null && $this->family_id1 !== null ) {
            $this->family_id1->setHusb( null );
        }

        // set the owning side of the relation if necessary
        if ( $family_id1 !== null && $family_id1->getHusb() !== $this ) {
            $family_id1->setHusb( $this );
        }

        $this->family_id1 = $family_id1;

        return $this;
    }

    public function getFamilyId2(): ?Family {
        return $this->family_id2;
    }

    public function setFamilyId2( ?Family $family_id2 ): self {
        // unset the owning side of the relation if necessary
        if ( $family_id2 === null && $this->family_id2 !== null ) {
            $this->family_id2->setWife( null );
        }

        // set the owning side of the relation if necessary
        if ( $family_id2 !== null && $family_id2->getWife() !== $this ) {
            $family_id2->setWife( $this );
        }

        $this->family_id2 = $family_id2;

        return $this;
    }
}
