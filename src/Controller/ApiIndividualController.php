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
use       App\Entity\PersonalNameStructure;
use       App\Entity\Project;

use       App\Service\EditorService;


/**
*  ApiIndividualController
*  - Grundlæggende api funktioner
*
*/

#[Route('/api/editor/{url}/individual', name: 'api_individual_')]
class ApiIndividualController extends AbstractController
{
  private $editorService;
  private $entityManager;


  /**
   *   function __construct()
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
  * function new()
  *
  */

  #[Route('/new', name: 'new')]
  public function new(Request $request, Project $project) : JsonResponse
  {
    try
    {
      $id= $this->editorService->newIndividual($project);

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
  * function setSex()
  *
  */

  #[Route('/setSex', name: 'setSex', methods: ['POST'])]
  public function setSex(Request $request, Project $project, ManagerRegistry $doctrine)
  {
    try
    {

    }
    catch(\Exception $e)
    {

    }

  }



  /**
   *  function updatePersonalName()
   *
   *  Method Parameters
   *  indId:
   *  nameId:
   *
   */

  #[Route('/updatePersonalName', name: 'updatePersonalName', methods: ['PUT'])]
  public function updatePersonalName(Request $request, Project $project, ManagerRegistry $doctrine) : JsonResponse
  {
    try
    {
      $params = json_decode($request->getContent(), true);


      $indi= $project->getIndividuals()[$params['indiId']];
      $name= $indi->getPersonalNameStructures()->first();

      if ($indi)
      $temp= $indi->getPersonalNameStructures();

      if ($name)
      {
        if (array_key_exists('npfx', $params))
        {
          $name->setNpfx($params['npfx']);
        }
        if (array_key_exists('givn', $params))
        {
          $name->setGivn($params['givn']);
        }
        if (array_key_exists('nick', $params))
        {
          $name->setNick($params['nick']);
        }
        if (array_key_exists('spfx', $params))
        {
          $name->setSpfx($params['spfx']);
        }
        if (array_key_exists('surn', $params))
        {
          $name->setSurn($params['surn']);
        }
        if (array_key_exists('nsfx', $params))
        {
          $name->setNsfx($params['nsfx']);
        }

        // Genopbygger 'PersonalName'

        $this->editorService->rebuildPersonalName($name);

        // Opdaterer databasen

        $this->entityManager->persist($name);
        $this->entityManager->flush();
      }

      return $this->json(['stat' => 'Ok', 'result' => ['name' => $name->getPersonalName()]]);
    }
      catch(\Exception $e)
  {
    return $this->json(['stat' => 'Error', 'Message' => $e->getMessage()]);
  }

  }



  /**
   *  function next()
   *  - returnerer id for efterfølgende individ
   */

  #[Route('/next', name: 'next', methods: ['GET'])]
  public function next(Request $request, Project $project) : JsonResponse
  {

  }

  /**
   *  function previous()
   *  - returnerer id for efterfølgende individ
   */

  #[Route('/prev', name: 'prev', methods: ['GET'])]
  public function previous(Request $request, Project $project) : JsonResponse
  {

  }




}
