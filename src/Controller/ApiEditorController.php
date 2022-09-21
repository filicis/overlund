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
*  ApiEditorController
*  - Grundlæggende api funktioner
*
*/

#[Route('/api/editor/{url}', name: 'api_editor_')]
class ApiEditorController extends AbstractController
{
  /**
  *
  */

  private $editorService;
  private $entityManager;


  /**
  *
  *
  */

  function __construct(ManagerRegistry $doctrine, EditorService $es)
  {
    $this->entityManager= $doctrine->getManager();
    $this->editorService= $es;
  }


  /**
  *  function import()
  *
  */

  #[Route('/import', name: 'import')]
  public function import(Request $request, Project $project ) : Response
  {
    $params = json_decode($request->getContent(), true);


    return $this->json(['svar' => 'yes',]);
  }


}