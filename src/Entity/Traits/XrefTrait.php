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

use       App\Entity\NoteCollection;


  /**
   *  XrefTrait
   *
   **/

trait XrefTrait
{

  /**
   *  xref
   */

  #[ORM\Column(type: "string", length: 20, nullable: true)]
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

