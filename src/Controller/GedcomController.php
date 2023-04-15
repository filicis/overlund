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

namespace App\Controller;

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;
use       Symfony\Component\HttpFoundation\Request;

use       Doctrine\Persistence\ManagerRegistry;

use       App\Entity\Project;

use       App\Service\GedcomService;



/**
 *  GedcomController
 *  - Indeholder alle system funktioner omkring GEDCOM filer
 *
 **/

class GedcomController extends AbstractController
{

  /**
   * Gedcom import 
   */

  #[Route('/gedcom/{url}/import', name: 'gedcomImport')]
  public function import(Request $request, Project $project): Response
  {
    try
    {

    }
    catch(Exception $e)
    {

    }


    return $this->render('gedcom/index.html.twig', [
          'controller_name' => 'GedcomController',
    ]);
  }
}
