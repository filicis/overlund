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


  /**
   *  Sortorder
   *
   **/

trait Sortorder
{
  /**
   *  sortorder
   */

  #[ORM\Column(type: "integer", nullable: true)]
  private $sortorder;


  public function getSortorder(): ?int
  {
      return $this->sortorder;
  }


  public function setSortorder(?int $sortorder) : self
  {
      $this->sortorder = $sortorder;

      return $this;
  }



}
