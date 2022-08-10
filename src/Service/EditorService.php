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

namespace   App\Service;

use       Doctrine\Persistence\ManagerRegistry;
use       Symfony\Component\Uid\Ulid;

use       App\Entity\Family;
use       App\Entity\Individual;
use       App\Entity\PersonalNameStructure;
use       App\Entity\Project;



  /**
   *  class EditorService
   *
   */

class EditorService
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
   *  function addChild()
   *
   */

  public function addChild(Family $family, Individual $individual)
  {
  }

  /**
   *  function addHusband()
   *
   */

  public function addHusband(Family $family, Individual $individual)
  {
  }



  /**
   *  function addWife(Family $family, Individual $individual)
   *
   */

  public function addWife()
  {
  }

  /**
   *  function newFamily()
   *
   */

  public function newFamily(Project $project): ?Ulid
  {
    try
    {
      $fam= new Family();
      $project->addFamily($fam);

      $this->entityManager->persist($project);
      $this->entityManager->persist($fam);
      $this->entityManager->flush();

      return $fam->getId();
    }
    catch(\Exception $e)
    {
    }
    return null;
  }

  //
  //  function newIndividual()
  //

  public function newIndividual(Project $project): ?Ulid
  {
    try
    {
      $indi= new Individual();
      $project->addIndividual($indi);

      $this->entityManager->persist($project);
      $this->entityManager->persist($indi);
      $this->entityManager->flush();

      return $indi->getId();
    }
    catch(\Exception $e)
    {
    }
    return null;
  }

  //
  //  function newPersonalName
  //

  public function newPersonalName(Individual $indi) :?Ulid
  {
    $name= new PersonalNameStructure();
    $indi->addPersonalNameStructure($name);

    $this->entityManager->persist($name);
    $this->entityManager->flush();

    return $name->getId();
  }
}


