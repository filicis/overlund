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

use 			Doctrine\ORM\Mapping as ORM;

use       App\Entity\NoteCollection;


  /**
   *  XrefTrait
   *
   **/

trait XrefTrait
{

  /**
   * @ORM\Column(type="string", length=20, nullable=true, options={"comment":"Friendly Identifier",})
   */

  private $xref;


  public function getXref(): ?string
  {
      return $this->xref;
  }


  public function setXref(?string $xref): self
  {
      $this->xref = $xref;

      return $this;
  }

}

