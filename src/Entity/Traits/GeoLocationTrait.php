<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/



namespace App\Entity\Traits;

use       Doctrine\ORM\Mapping as ORM;


  /**
   *  trait AddressTrait
   *  - Gedcom 7.0
   *
   *  Anvendes i:
   *  - HeaderRecord
   *  - RepositoryRecord
   *  - SubmitterRecord
   *  - Event*
   *
   **/


trait GeoLocationTrait
{

    /**
     * @ORM\Column(type="text", nullable=true)
     **/
    private $lati;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     **/
    private $long;


    public function getLati(): ?string
    {
        return $this->lati;
    }

    public function setLati(?string $lati): self
    {
        $this->lati = $lati;

        return $this;
    }

    public function getLong(): ?string
    {
        return $this->long;
    }

    public function setLong(?string $long): self
    {
        $this->long = $long;

        return $this;
    }

}
