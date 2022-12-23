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

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\IdentifierLink;

/**
*  trait IdentifierTrait
*
*  Anvendes af:
*  - Family
*  - Individual
*  - SourceRecord
*  - SubmitterRecord
*  - Event
*  - SourceCitation
**/

trait IdentifierTrait
 {

    #[ ORM\OneToOne( targetEntity: 'IdentifierLink', cascade: [ 'persist' ], fetch: 'LAZY' ) ]
    #[ ORM\JoinColumn( nullable: true, onDelete: 'Cascade' ) ]
    private ? IdentifierLink $identifierLink = null;

    //***************************************************************************
    //***************************************************************************
    //***************************************************************************

    /**
    *  function hasIdentifierLink()
    *
    **/

    public function hasIdentifierLink(): bool
 {
        return ( $this->identifierLink != null );
    }

    /**
    *  function getIdentifierLink()
    *
    **/

    public function getIdentifierLink(): ? IdentifierLink
 {
        return ( $this->hasIdentifierLink() ) ? $this->identifierLink : $this->newIdentifierLink();
    }

    private function newIdentifierLink(): IdentifierLink
 {
        return $this->identifierLink = new IdentifierLink();
    }

    /**
    *  function setIdentifierlink()
    *
    **/

    public function setIdentifierLink( IdentifierLink $identifierLink ): self
 {
        $this->identifierLink = $identifierLink;

        return $this;
    }

}