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

use App\Repository\FamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Individual;
use App\Entity\RecordSuperclass;
use App\Entity\Relation;

use App\Entity\Traits\IdentifierTrait;
use App\Entity\Traits\MediaTrait;
use App\Entity\Traits\Restrictions;

use App\Entity\Media;

/**
*  Family
*  Implementerer Gedcom FAMILY_RECORD
*
*  @link https://gedcom.io/terms/v7/record-FAM
*
*/

#[ ORM\Entity( repositoryClass: FamilyRepository::class ) ]

class Family extends RecordSuperclass {
    use IdentifierTrait, Restrictions, MediaTrait;

    protected const XREF_PREFIX = 'F';

    /**
    *    project
    */

    #[ ORM\ManyToOne( targetEntity: Project::class, inversedBy: 'families' ) ]
    private $project;

    /**
    *  chil
    *  - Implementerer Gedcom chil
    */

    #[ ORM\OneToMany( mappedBy: 'family', targetEntity: Relation::class, cascade: [ 'persist', ], ) ]
    private Collection $chil;

    #[ ORM\OneToOne( inversedBy: 'family_id1', cascade: [ 'persist', 'remove' ] ) ]
    private ? Relation $husb = null;

    #[ ORM\OneToOne( inversedBy: 'family_id2', cascade: [ 'persist', 'remove' ] ) ]
    private ? Relation $wife = null;

    // ********************************************
    // ********************************************
    // ********************************************

    /**
    * Summary of __construct
    */

    public function __construct() {
        $this->chil = new ArrayCollection();
    }

    /**
    *  function getProject()
    */

    public function getProject(): ? Project {
        return $this->project;
    }

    /**
    *  function setProject()
    */

    public function setProject( ? Project $project ): self {
        $this->project = $project;

        return $this;
    }

    /**
    * @return Collection<int, Relation>
    */

    public function getChil(): Collection {
        return $this->chil;
    }

    public function addChil( Relation $chil ): self {
        if ( !$this->chil->contains( $chil ) ) {
            $this->chil->add( $chil );
            $chil->setFamily( $this );
        }

        return $this;
    }

    public function removeChil( Relation $chil ): self {
        if ( $this->chil->removeElement( $chil ) ) {
            // set the owning side to null ( unless already changed )
            if ( $chil->getFamily() === $this ) {
                $chil->setFamily( null );
            }
        }

        return $this;
    }

    public function getHusb(): ? Relation {
        return $this->husb;
    }

    public function setHusb( ? Relation $husb ): self {
        $this->husb = $husb;

        return $this;
    }

    public function getWife(): ? Relation {
        return $this->wife;
    }

    public function setWife( ? Relation $wife ): self {
        $this->wife = $wife;

        return $this;
    }

}