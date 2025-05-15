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

use       App\Repository\RepositoryRecordRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;
use       App\Entity\AddressStructure;

use       Symfony\Component\Validator\Constraints as Assert;

/**
*  Class RepositoryRecord
*
*  Implementerer Gedcom v7 REPOSITORY_RECORD
*  - https://gedcom.io/terms/v7/record-REPO
*
**/

#[ ORM\Entity( repositoryClass: RepositoryRecordRepository::class ) ]
#[ ORM\Table( name: 'repositoryrecord' ) ]

class RepositoryRecord extends RecordSuperclass {

    protected const XREF_PREFIX = 'R';

    /**
    *  name
    *
    *  - https://gedcom.io/terms/v7/NAME
    **/

    #[ ORM\Column( type: 'string', length: 255 ) ]
    private $name;

    #[ Assert\Type( type: AddressStructure::class ) ]
    #[ Assert\Valid ]
    #[ Embedded( class: AddressStructure::class, columnPrefix: false ) ]
    private AddressStructure $address;

    #[ ORM\OneToMany( mappedBy: 'repositoryRecord', targetEntity: SourceRepositoryCitation::class, orphanRemoval: true ) ]
    private Collection $citations;

    #[ ORM\ManyToOne( inversedBy: 'repositoryRecords' ) ]
    //# [ ORM\JoinColumn( nullable: false ) ]
    private ?Project $project = null;

    public function __construct() {
        parent::__construct();
        $this->address = new AddressStructure();
        $this->citations = new ArrayCollection();
    }

    /**
    *
    **/

    public function getName(): ?string {
        return $this->name;
    }

    /**
    *
    **/

    public function setName( string $name ): self {
        $this->name = $name;

        return $this;
    }

    /**
    * @return Collection<int, SourceRepositoryCitation>
    */

    public function getCitations(): Collection {
        return $this->citations;
    }

    public function addCitation( SourceRepositoryCitation $citation ): self {
        if ( !$this->citations->contains( $citation ) ) {
            $this->citations->add( $citation );
            $citation->setRepositoryRecord( $this );
        }

        return $this;
    }

    public function removeCitation( SourceRepositoryCitation $citation ): self {
        if ( $this->citations->removeElement( $citation ) ) {
            // set the owning side to null ( unless already changed )
            if ( $citation->getRepositoryRecord() === $this ) {
                $citation->setRepositoryRecord( null );
            }
        }

        return $this;
    }

    public function getProject(): ?Project {
        return $this->project;
    }

    public function setProject( ?Project $project ): self {
        $this->project = $project;

        return $this;
    }

    public function getAddress(): ?AddressStructure {
        return $this->address;
    }

    public function setAddress( ?AddressStructure $address ) {
        $this->address = $address;
    }
}
