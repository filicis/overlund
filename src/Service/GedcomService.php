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
  private $em;

  /**
   *  function __construct()
   *
   */

  function __construct(ManagerRegistry $doctrine)
  {
    $this->em= $doctrine->getManager();
  }


  /**
   * function reset()
   * - 
   */

  public function reset(Project $project)
  {
    $cmd= 'DELETE MyProject\Model\User u WHERE u.id = 4';

    $query= $em->createQuery($cmd);
    $query->setParameter(1, 12);
    $res= $query->getResult();
  }


  /**
   * function import()
   * - 
   */

  
  public function import(Project $project, Array $lines)
  {
  }  

  /**
   * function concat()
   * - Concat pseudo-structures CONC/CONT into superstructures payload
   *
   **/ 

  public function concat(Project $project)
  {}


  /**
   * function split(Project $project)
   * - Split payload into pseudo-structures CONC/CONT
   *
   **/

  public function split(Project $project)
  {}  

}

