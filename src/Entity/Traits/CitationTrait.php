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

use 			Doctrine\ORM\Mapping as ORM;

use       App\Entity\IdentifierLink;


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


trait CitationTrait
{

  #[ORM\OneToOne(targetEntity: "CitationLink", cascade: ['persist'], fetch: 'LAZY')]
  #[ORM\JoinColumn(nullable: true, onDelete: 'Cascade')]
  private ?CitationLink $citationLink = null;

  //***************************************************************************
  //***************************************************************************
  //***************************************************************************


  /**
   *  function hasCitationLink()
   *
   **/

  public function hasCitationLink() : bool
  {
    return ($this->citationLink != null);
  }  


  /**
   *  function getCitationLink()
   *
   **/

  public function getCitationLink(): ?CitationLink
  {
    return ($this->hasCitationLink()) ? $this->citationLink : $this->newCitationLink();
  }


  private function newCitationLink() : CitationLink
  {
    return $this->citationLink= new CitationLink(); 
  }  


}

