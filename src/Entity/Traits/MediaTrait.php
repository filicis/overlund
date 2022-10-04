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

use       App\Entity\Media;


  /**
   *  trait MediaTrait
   *
   *  Anvendes af:
   *  - Family
   *  - Individual
   *  - SourceRecord
   *  - SubmitterRecord
   *  - Event
   *  - SourceCitation
   **/

trait MediaTrait
{

  #[ORM\OneToOne(targetEntity: "Media", cascade: ['persist', 'remove'])]
  #[ORM\JoinColumn(nullable: false)]
  private ?Media $media = null;

  //***************************************************************************
  //***************************************************************************
  //***************************************************************************


  /**
   *  function __construct
   *
   */
/*
  public function __construct()
  {
    $this->media= new Media();
  }
*/


  public function getMedia(): ?Media
  {
    return $this->media;
  }

  public function setMedia(Media $media): self
  {
    $this->media = $media;

    return $this;
  }


}

