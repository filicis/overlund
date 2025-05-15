<?php

/**
* This file is part of the Overlund package.
*
* ( c ) Michael Lindhardt Rasmussen <filicis@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
**/

namespace App\Entity;

use       Doctrine\ORM\Mapping as ORM;

use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use       Symfony\Component\Uid\Ulid;
use       Symfony\Bridge\Doctrine\Types\UlidType;

use       App\Repository\ProjectRepository;

use       App\Entity\GedcomStructure;

use       App\Entity\MediaRecord;
use       App\Entity\SubmitterRecord;
use       App\Entity\RepositoryRecord;
use       App\Entity\SourceRecord;

/**
*  Project
*  -
*
*
**/

#[ ORM\Entity( repositoryClass: ProjectRepository::class ) ]

class Project {

    #[ORM\Id]
    #[ORM\Column(type: UlidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    private $id;


    /**
     *  title
     */

    #[ ORM\Column( type: 'string', length: 80 ) ]
    private $title;

    /**
    *
    */

    #[ ORM\Column( type: 'string', unique: true, length: 30 ) ]
    private $url;

    /**
    *
    */

    #[ ORM\OneToMany( targetEntity: Family::class, mappedBy: 'project', indexBy: 'id', fetch: 'EXTRA_LAZY' ) ]
    private $families;

    /**
    *
    */

    #[ ORM\OneToMany( targetEntity: Individual::class, mappedBy: 'project', indexBy: 'id', fetch: 'EXTRA_LAZY' ) ]
    private $individuals;

    /**
    *
    */

    #[ ORM\OneToMany( targetEntity: SubmitterRecord::class, mappedBy: 'project', fetch: 'EXTRA_LAZY' ) ]
    private $submitterRecords;

    /**
    *
    */

    #[ ORM\OneToMany( targetEntity: MediaRecord::class, mappedBy: 'project', fetch: 'EXTRA_LAZY' ) ]
    private $mediaRecords;

    /**
    */

    #[ ORM\OneToMany( targetEntity: PlaceRecord::class, mappedBy: 'project', fetch: 'EXTRA_LAZY' ) ]
    private $placeRecords;

    #[ ORM\Column( type: 'string', length: 255, nullable: true ) ]
    private $GedcomFilename;

    /**
    *  language
    *  - Default language for this project
    */

    #[ ORM\Column( length: 5, nullable: true ) ]
    private ?string $language = null;

    /**
    *  placeForm
    *  - Default PLAC FORM
    *
    */

    #[ ORM\Column( length: 80, nullable: true ) ]
    private ?string $placForm = null;

    #[ ORM\OneToMany( mappedBy: 'project', targetEntity: GedcomStructure::class, orphanRemoval: true ) ]
    private Collection $gedcomStructures;

    #[ ORM\Column( length: 30, nullable: true ) ]
    private ?string $workflowPlace = null;

    #[ ORM\OneToMany( targetEntity: SourceRecord::class, mappedBy: 'project', cascade: [ 'persist' ], orphanRemoval: true ) ]
    private Collection $sourceRecords;

    #[ ORM\OneToMany( mappedBy: 'project', targetEntity: RepositoryRecord::class, orphanRemoval: true, cascade: [ 'persist', ], fetch: 'EXTRA_LAZY' ) ]
    private Collection $repositoryRecords;

    public function __construct() {
        $this->families = new ArrayCollection();
        $this->individuals = new ArrayCollection();
        $this->submitterRecords = new ArrayCollection();
        $this->mediaRecords = new ArrayCollection();
        $this->placeRecords = new ArrayCollection();
        $this->gedcomStructures = new ArrayCollection();

        $this->workflowPlace = 'init';
        $this->sourceRecords = new ArrayCollection();
        $this->repositoryRecords = new ArrayCollection();
    }



    /**
     *  getId()
     *
     **/

    public function getId(): ?Ulid
    {
        return $this->id;
    }


    /**
     *
     **/

    public function __toString() {
        return $this->url . ' - ' . $this->title;
    }


    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle( string $title ): self {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl( string $url ): self {
        $this->url = $url;

        return $this;
    }

    /**
    * @return Collection|Family[]
    */

    public function getFamilies(): Collection {
        return $this->families;
    }

    public function addFamily( Family $family ): self {
        if ( !$this->families->contains( $family ) ) {
            $this->families[] = $family;
            $family->setProject( $this );
        }

        return $this;
    }

    public function removeFamily( Family $family ): self {
        if ( $this->families->removeElement( $family ) ) {
            // set the owning side to null ( unless already changed )
            if ( $family->getProject() === $this ) {
                $family->setProject( null );
            }
        }

        return $this;
    }

    /**
    * @return Collection|Individual[]
    */

    public function getIndividuals(): Collection {
        return $this->individuals;
    }

    public function addIndividual( Individual $individual ): self {
        if ( !$this->individuals->contains( $individual ) ) {
            $this->individuals[] = $individual;
            $individual->setProject( $this );
        }

        return $this;
    }

    public function removeIndividual( Individual $individual ): self {
        if ( $this->individuals->removeElement( $individual ) ) {
            // set the owning side to null ( unless already changed )
            if ( $individual->getProject() === $this ) {
                $individual->setProject( null );
            }
        }

        return $this;
    }

    /**
    * @return Collection|SubmitterRecord[]
    */

    public function getSubmitterRecords(): Collection {
        return $this->submitterRecords;
    }

    public function addSubmitterRecord( SubmitterRecord $submitterRecord ): self {
        if ( !$this->submitterRecords->contains( $submitterRecord ) ) {
            $this->submitterRecords[] = $submitterRecord;
            $submitterRecord->setProject( $this );
        }

        return $this;
    }

    public function removeSubmitterRecord( SubmitterRecord $submitterRecord ): self {
        if ( $this->submitterRecords->removeElement( $submitterRecord ) ) {
            // set the owning side to null ( unless already changed )
            if ( $submitterRecord->getProject() === $this ) {
                $submitterRecord->setProject( null );
            }
        }

        return $this;
    }

    /**
    * @return Collection|MediaRecord[]
    */

    public function getMediaRecords(): Collection {
        return $this->mediaRecords;
    }

    public function addMediaRecord( MediaRecord $mediaRecord ): self {
        if ( !$this->mediaRecords->contains( $mediaRecord ) ) {
            $this->mediaRecords[] = $mediaRecord;
            $mediaRecord->setProject( $this );
        }

        return $this;
    }

    public function removeMediaRecord( MediaRecord $mediaRecord ): self {
        if ( $this->mediaRecords->removeElement( $mediaRecord ) ) {
            // set the owning side to null ( unless already changed )
            if ( $mediaRecord->getProject() === $this ) {
                $mediaRecord->setProject( null );
            }
        }

        return $this;
    }

    /**
    * @return Collection|PlaceRecord[]
    */

    public function getPlaceRecords(): Collection {
        return $this->placeRecords;
    }

    public function addPlaceRecord( PlaceRecord $placeRecord ): self {
        if ( !$this->placeRecords->contains( $placeRecord ) ) {
            $this->placeRecords[] = $placeRecord;
            $placeRecord->setProject( $this );
        }

        return $this;
    }

    public function removePlaceRecord( PlaceRecord $placeRecord ): self {
        if ( $this->placeRecords->removeElement( $placeRecord ) ) {
            // set the owning side to null ( unless already changed )
            if ( $placeRecord->getProject() === $this ) {
                $placeRecord->setProject( null );
            }
        }

        return $this;
    }

    public function getGedcomFilename(): ?string {
        return $this->GedcomFilename;
    }

    public function setGedcomFilename( ?string $GedcomFilename ): self {
        $this->GedcomFilename = $GedcomFilename;

        return $this;
    }

    public function getLanguage(): ?string {
        return $this->language;
    }

    public function setLanguage( ?string $language ): self {
        $this->language = $language;

        return $this;
    }

    public function getPlacForm(): ?string {
        return $this->placForm;
    }

    public function setPlacForm( ?string $placForm ): self {
        $this->placForm = $placForm;

        return $this;
    }

    /**
    * @return Collection<int, GedcomStructure>
    */

    public function getGedcomStructures(): Collection {
        return $this->gedcomStructures;
    }

    public function addGedcomStructure( GedcomStructure $gedcomStructure ): self {
        if ( !$this->gedcomStructures->contains( $gedcomStructure ) ) {
            $this->gedcomStructures->add( $gedcomStructure );
            $gedcomStructure->setProject( $this );
        }

        return $this;
    }

    public function removeGedcomStructure( GedcomStructure $gedcomStructure ): self {
        if ( $this->gedcomStructures->removeElement( $gedcomStructure ) ) {
            // set the owning side to null ( unless already changed )
            if ( $gedcomStructure->getProject() === $this ) {
                $gedcomStructure->setProject( null );
            }
        }

        return $this;
    }

    public function getWorkflowPlace(): ?string {
        return $this->workflowPlace;
    }

    public function setWorkflowPlace( ?string $workflowPlace ): self {
        $this->workflowPlace = $workflowPlace;

        return $this;
    }

    /**
    * @return Collection<int, SourceRecord>
    */

    public function getSourceRecords(): Collection {
        return $this->sourceRecords;
    }

    public function addSourceRecord( SourceRecord $sourceRecord ): self {
        if ( !$this->sourceRecords->contains( $sourceRecord ) ) {
            $this->sourceRecords->add( $sourceRecord );
            $sourceRecord->setProject( $this );
        }

        return $this;
    }

    public function removeSourceRecord( SourceRecord $sourceRecord ): self {
        if ( $this->sourceRecords->removeElement( $sourceRecord ) ) {
            // set the owning side to null ( unless already changed )
            if ( $sourceRecord->getProject() === $this ) {
                $sourceRecord->setProject( null );
            }
        }

        return $this;
    }

    /**
    * @return Collection<int, RepositoryRecord>
    */

    public function getRepositoryRecords(): Collection {
        return $this->repositoryRecords;
    }

    public function addRepositoryRecord( RepositoryRecord $repositoryRecord ): self {
        if ( !$this->repositoryRecords->contains( $repositoryRecord ) ) {
            $this->repositoryRecords->add( $repositoryRecord );
            $repositoryRecord->setProject( $this );
        }

        return $this;
    }

    public function removeRepositoryRecord( RepositoryRecord $repositoryRecord ): self {
        if ( $this->repositoryRecords->removeElement( $repositoryRecord ) ) {
            // set the owning side to null ( unless already changed )
            if ( $repositoryRecord->getProject() === $this ) {
                $repositoryRecord->setProject( null );
            }
        }

        return $this;
    }

}
