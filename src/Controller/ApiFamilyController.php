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
use       Symfony\Component\HttpFoundation\JsonResponse;
use       Symfony\Component\Routing\Annotation\Route;

use       Doctrine\Persistence\ManagerRegistry;

use       App\Entity\Family;
use       App\Entity\Individual;
use       App\Entity\Project;

use       App\Service\EditorService;


/**
*  ApiFamilyController
*  - Grundlæggende api funktioner
*
*/

#[Route('/api/editor/{url}/family', name: 'api_family_')]
class ApiFamilyController extends AbstractController
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
   * function delete()
   *
   */

  #[Route('/delete', name: 'delete', methods: ['POST'])]
  public function delete()
  {

  }


  /**
  *  function new()
  *
  */

  #[Route('/new', name: 'new')]
  public function new(Request $request, Project $project, ManagerRegistry $doctrine) : JsonResponse
  {
    //try
    //{
      $fam= new Family();
      $project->addFamily($fam);

      $entityManager= $doctrine->getManager();

      $entityManager->persist($project);
      $entityManager->persist($fam);

      $entityManager->flush();

      $id= $fam->getId();
      $dummy= array('id' => $id,);

      //return $this->json(['id' => $fam->getId()]);
      return $this->json($dummy);
    //}
    //catch(\Exception $e)
    //{
    //}

  }



  /**
   * function setRestriction()
   *
   */

  #[Route('/setRestriction', name: 'setRestriction', methods: ['POST'])]
  public function setRestriction()
  {

  }




}
