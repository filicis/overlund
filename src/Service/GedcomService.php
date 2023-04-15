<?php

/**
* This file is part of the Overlund package.
*
* @author Michael Lindhardt Rasmussen <filicis@gmail.com>
* @copyright 2000-2023 Filicis Software
* @license MIT
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/


namespace App\Service;

use       Doctrine\Persistence\ManagerRegistry;
use       Symfony\Component\Uid\Ulid;

use       App\Entity\Family;
use       App\Entity\Individual;
use       App\Entity\GedcomStructure;
use       App\Entity\PersonalNameStructure;
use       App\Entity\Project;



/**
 *  class GedcomService
 */


class GedcomService
{
  private $entityManager;

  /**
   *  function __construct()
   *
   */

  function __construct(ManagerRegistry $doctrine)
  {
    $this->entityManager= $doctrine->getManager();
  }


  /**
   * function reset()
   * - 
   */

  public function reset(Project $project)
  {
  }


  /**
   * function import()
   * - 
   */

  
  public function import(Project $project, Array $lines)
  {
  }  
}

