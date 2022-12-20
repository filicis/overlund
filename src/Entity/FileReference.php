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

use App\Repository\FileReferenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
*  enumset-Medi
*/

enum MediaRole: string {
    case AUDIO        = 'Audio';
    case BOOK         = 'Book';
    case CARD         = 'Card';
    case ELECTRNIC    = 'Electronic';
    case FICHE        = 'Fiche';
    case FILM         = 'Film';
    case MAGAZINE     = 'Magazine';
    case MANUSCRIPT   = 'Manuscript';
    case MAP          = 'MAP';
    case NEWSPAPER    = 'Newspaper';
    case PHOTO        = 'Photo';
    case TOOMBSTONE   = 'Toombstrone';
    case VIDEO        = 'Video';
    case OTHER        = 'Other';
}

/**
*  class FileReference
*  - Del af Gedcom v7 MULTIMEDIA_RECORD
*
*  Indeholder en eller flere media elementer
*/

#[ ORM\Entity( repositoryClass: FileReferenceRepository::class ) ]

class FileReference {
    #[ ORM\Id ]
    #[ ORM\GeneratedValue ]
    #[ ORM\Column ]
    private ?int $id = null;

    #[ ORM\OneToMany( mappedBy: 'fileReference', targetEntity: MediaElement::class, cascade: [ 'persist' ], orphanRemoval: true ) ]
    private Collection $mediaElements;

    #[ ORM\Column( length: 255 ) ]
    private ?string $title = null;

    /**
    *  medium
    *
    **/

    #[ ORM\Column( length: 80, nullable: true ) ]
    private ?string $medium = null;

    /**
    *
    */

    #[ ORM\ManyToOne( inversedBy: 'fileReferences' ) ]
    private ?MediaRecord $mediaRecord = null;

    /**
    *  function __construct()
    */

    public function __construct() {
        $this->mediaElements = new ArrayCollection();
    }

    /**
    *  function getId()
    */

    public function getId(): ?int {
        return $this->id;
    }

    /**
    * @return Collection<int, MediaElement>
    */

    public function getMediaElements(): Collection {
        return $this->mediaElements;
    }

    public function addMediaElement( MediaElement $mediaElement ): self {
        if ( !$this->mediaElements->contains( $mediaElement ) ) {
            $this->mediaElements->add( $mediaElement );
            $mediaElement->setFileReference( $this );
        }

        return $this;
    }

    public function removeMediaElement( MediaElement $mediaElement ): self {
        if ( $this->mediaElements->removeElement( $mediaElement ) ) {
            // set the owning side to null ( unless already changed )
            if ( $mediaElement->getFileReference() === $this ) {
                $mediaElement->setFileReference( null );
            }
        }

        return $this;
    }

    public function getMedium(): ?string {
        return $this->medium;
    }

    public function setMedium( ?string $medium ): self {
        $this->medium = $medium;

        return $this;
    }

    /**
    *  function getTitle()
    */

    public function getTitle(): ?string {
        return $this->title;
    }

    /**
    *  function setTitle
    */

    public function setTitle( string $title ): self {
        $this->title = $title;

        return $this;
    }

    public function getMediaRecord(): ?MediaRecord {
        return $this->mediaRecord;
    }

    public function setMediaRecord( ?MediaRecord $mediaRecord ): self {
        $this->mediaRecord = $mediaRecord;

        return $this;
    }
}
