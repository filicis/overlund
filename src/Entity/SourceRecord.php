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

use       App\Repository\SourceRecordRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;
use       App\Entity\Project;
use       App\Entity\Traits\IdentifierTrait;

/**
*  class SourceRecord
*
*  Implementerer Gedcom v7 SOURCE_RECORD
**/

#[ ORM\Entity( repositoryClass: SourceRecordRepository::class ) ]
#[ ORM\Table( name: 'sourcerecord' ) ]

class SourceRecord  extends RecordSuperclass {
    use IdentifierTrait;

    protected const XREF_PREFIX = 'S';

    #[ ORM\Column( length: 255, nullable: true ) ]
    private ?string $author = null;

    #[ ORM\Column( length: 255, nullable: true ) ]
    private ?string $title = null;

    #[ ORM\Column( length: 255, nullable: true ) ]
    private ?string $Abbreviation = null;

    #[ ORM\Column( length: 255, nullable: true ) ]
    private ?string $publication = null;

    #[ ORM\OneToMany( mappedBy: 'sourceRecord', targetEntity: SourceRepositoryCitation::class, orphanRemoval: true ) ]
    private Collection $repositoryCitations;

    #[ ORM\ManyToOne( inversedBy: 'sourceRecords' ) ]
    #[ ORM\JoinColumn( nullable: false ) ]
    private ?Project $project = null;

    public function __construct() {
        parent::__construct();
        $this->repositoryCitations = new ArrayCollection();
    }

    /**
    *
    **/

    public function getAuthor(): ?string {
        return $this->author;
    }

    /**
    *
    **/

    public function setAuthor( ?string $author ): self {
        $this->author = $author;

        return $this;
    }

    /**
    *
    **/

    public function getTitle(): ?string {
        return $this->title;
    }

    /**
    *
    **/

    public function setTitle( ?string $title ): self {
        $this->title = $title;

        return $this;
    }

    /**
    *
    **/

    public function getAbbreviation(): ?string {
        return $this->Abbreviation;
    }

    /**
    *
    **/

    public function setAbbreviation( ?string $Abbreviation ): self {
        $this->Abbreviation = $Abbreviation;

        return $this;
    }

    /**
    *
    **/

    public function getPublication(): ?string {
        return $this->publication;
    }

    /**
    *
    **/

    public function setPublication( ?string $publication ): self {
        $this->publication = $publication;

        return $this;
    }

    /**
    * @return Collection<int, SourceRepositoryCitation>
    */

    public function getRepositoryCitations(): Collection {
        return $this->repositoryCitations;
    }

    public function addRepositoryCitation( SourceRepositoryCitation $repositoryCitation ): self {
        if ( !$this->repositoryCitations->contains( $repositoryCitation ) ) {
            $this->repositoryCitations->add( $repositoryCitation );
            $repositoryCitation->setSourceRecord( $this );
        }

        return $this;
    }

    public function removeRepositoryCitation( SourceRepositoryCitation $repositoryCitation ): self {
        if ( $this->repositoryCitations->removeElement( $repositoryCitation ) ) {
            // set the owning side to null ( unless already changed )
            if ( $repositoryCitation->getSourceRecord() === $this ) {
                $repositoryCitation->setSourceRecord( null );
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
}
