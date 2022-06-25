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


namespace App\Controller;

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\HttpFoundation\Request;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;

use       Doctrine\Persistence\ManagerRegistry;


use       App\Entity\Family;
use       App\Entity\Individual;
use       App\Entity\Project;


/**
*  ApiIndividualController
*  - Grundlæggende api funktioner
*
*/

#[Route('/api/editor/{url}/individual', name: 'api_individual_')]
class ApiIndividualController extends AbstractController
{
  #[Route('/webapi', name: 'webapi')]
  public function index(): Response
  {
    return $this->render('webapi/index.html.twig', [
    'controller_name' => 'WebapiController',
    ]);
  }

  /**
  *  function GetVersion()
  *
  * @return Return the Overlund version:
  */

  #[Route('/getVersion', name: 'getVersion')]
  public function getVersion() : Response
  {
    return $this->json(['svar' => 'yes',]);
  }


  /**
  *
  *
  */

  #[Route('/new', name: 'new')]
  public function new(Request $request, Project $project, ManagerRegistry $doctrine) : Response
  {
    try
    {
      $indi= new Individual();
      $project->addIndividual($indi);

      $entityManager= $doctrine->getManager();
      $entityManager->persist($project);
      $entityManager->persist($indi);
      $entityManager->flush();

      return $this->json(['id' => $indi->getId(),]);
    }
    catch(\Exception $e)
    {
    }

  }

}
