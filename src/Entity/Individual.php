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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\IndividualRepository;
use Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;
use       App\Entity\Relation;
use       App\Entity\NameStructure;

use       App\Entity\Traits\IdentifierTrait;
;
use       App\Entity\Traits\MediaTrait;
;
use       App\Entity\Traits\Restrictions;

use       App\Entity\Media;

/**
*  Individual
*  Implementerer Gedcom INDIVIDUAL_RECORD
**/

#[ ORM\Entity( repositoryClass:  IndividualRepository::class ) ]

class Individual extends RecordSuperclass {
    use IdentifierTrait, Restrictions, MediaTrait;

    protected const XREF_PREFIX = 'I';

    /**
    *
    *  @var project Pointer til ejer projektet
    */

    #[ ORM\ManyToOne( targetEntity: Project::class, inversedBy: 'individuals' ) ]
    private $project;

    /**
    *
    */

    #[ ORM\Column( type: 'string', length: 1, nullable: true ) ]
    private $sex;

    /**
    * relations
    * - Kombinerer FAMC og FAMS

    */

    #[ ORM\OneToMany( mappedBy: 'individual', targetEntity: Relation::class, fetch: 'EAGER' ) ]
    private $fams;

    #[ ORM\OneToMany( mappedBy: 'individual', targetEntity: Relation::class, fetch: 'EAGER' ) ]
    private $famc;

    /**
    * fams
    */

    /**
    * famc
    *
    */

    #[ ORM\OneToMany( mappedBy: 'indi', targetEntity: AliaStructure::class, fetch: 'EAGER' ) ]
    private Collection $alia;

    #[ ORM\OneToMany( mappedBy: 'individual', targetEntity: NameStructure::class, indexBy: 'id', cascade: [ 'persist' ], fetch: 'EAGER' ) ]
    private Collection $names;

    // ******************************************
    // ******************************************
    // ******************************************

    /**
    *
    *
    */

    public function __construct() {
        $this->alia = new ArrayCollection();
        $this->names = new ArrayCollection();
        $this->fams = new ArrayCollection();
        $this->famc = new ArrayCollection();

        $n = new NameStructure();
        $this->addName( $n );
        $this->media = new Media();
    }

    public function getProject(): ?Project {
        return $this->project;
    }

    public function setProject( ?Project $project ): self {
        $this->project = $project;

        return $this;
    }

    public function getSex(): ?string {
        return $this->sex;
    }

    public function setSex( ?string $sex ): self {
        $this->sex = $sex;

        return $this;
    }

    /**
    * @return Collection<int, Relation>
    */

    public function getFams(): Collection {
        return $this->fams;
    }

    /**
    *  function getName()
    *  - Temporary Implemantation
    *
    *
    *  @return String This individuals primary personal name
    */

    public function getName() {
        return $this->getNames()->first()->getPersonalName();
    }

    /**
    *  function getImage()
    *  - Temporary Implemantation
    *
    *
    *  @return String File reference
    */

    public function getImage() {
        return '\karen.jpg';
    }

    /**
    * @return Collection<int, AliaStructure>
    */

    public function getAlia(): Collection {
        return $this->alia;
    }

    public function addAlium( AliaStructure $alium ): self {
        if ( !$this->alia->contains( $alium ) ) {
            $this->alia->add( $alium );
            $alium->setIndi( $this );
        }

        return $this;
    }

    public function removeAlium( AliaStructure $alium ): self {
        if ( $this->alia->removeElement( $alium ) ) {
            // set the owning side to null ( unless already changed )
            if ( $alium->getIndi() === $this ) {
                $alium->setIndi( null );
            }
        }

        return $this;
    }

    /**
    * @return Collection<int, NameStructure>
    */

    public function getNames(): Collection {
        return $this->names;
    }

    public function addName( NameStructure $name ): self {
        if ( !$this->names->contains( $name ) ) {
            $this->names->add( $name );
            $name->setIndividual( $this );
        }

        return $this;
    }

    public function removeName( NameStructure $name ): self {
        if ( $this->names->removeElement( $name ) ) {
            // set the owning side to null ( unless already changed )
            if ( $name->getIndividual() === $this ) {
                $name->setIndividual( null );
            }
        }

        return $this;
    }

}
