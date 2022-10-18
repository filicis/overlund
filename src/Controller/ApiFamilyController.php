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
use       App\Entity\PersonalNameStructure;

use       App\Service\EditorService;


/**
*  ApiFamilyController
*  - Grundlæggende api funktioner
*
*/

#[Route('/api/editor/{url}/family', name: 'api_family_')]
class ApiFamilyController extends AbstractController
{
  private $editorService;
  private $entityManager;


  /**
   *  function __construct()
   *
   */

  function __construct(ManagerRegistry $doctrine, EditorService $es)
  {
    $this->entityManager= $doctrine->getManager();
    $this->editorService= $es;
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
  public function new(Request $request, Project $project) : JsonResponse
  {
    try
    {

      $id= $this->editorService->newFamily($project);

      return $this->json(['stat' => 'Ok', 'result' => ['id' => $id]]);
    }
    catch(\Exception $e)
    {
      return $this->json(['stat' => 'Error', 'Message' => $e->getMessage()]);
    }

  }



  /**
   * function setRestriction()
   *
   */

  #[Route('/setRestriction', name: 'setRestriction', methods: ['POST'])]
  public function setRestriction()
  {

  }


  /**
   * function newAsChild()
   *
   */

  #[Route('/newAsChild', name: 'newAsChild', methods: ['PUT'])]
  public function newAsChild(Request $request, Project $project) : JsonResponse
  {
    try
    {
      $id= $this->editorService->newAsChild($project);
      return $this->json(['stat' => 'Ok', 'result' => ['id' => true]]);
    }
    catch(\Exception $e)
    {
      return $this->json(['stat' => 'Error', 'Message' => $e->getMessage()]);
    }
  }




}
