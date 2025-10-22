<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/


namespace App\Controller;

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\HttpFoundation\Request;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;
use       Doctrine\Persistence\ManagerRegistry;


use       App\Entity\Project;
use       App\Repository\ProjectRepository;


  /**
   *  DefaultController
   *
   *  Håndterer systemet velkomstsside med generel information om systemet.
   *  - Siderne er ejet af systemadministrator
   **/

class DefaultController extends AbstractController
{
  #[Route('/', name: 'default')]
  public function index(Request $request, ManagerRegistry $doctrine): Response
  {
    return $this->render('default/index.html.twig', [
      'controller_name' => 'DefaultController',
      'documentTitle' => 'Velkomstside',
      'formTitle' => 'Default Controller',
    ]);


  }

  #[Route('/mlr', name: 'defaultmlr')]
  public function indexmlr(Request $request, ManagerRegistry $doctrine): Response
  {
    $cookies= $request->cookies;
    if ($cookies->has('PROJECT'))
    {
    }

    $projects = $doctrine->getRepository(Project::class)->findAll();

    if (! $projects) {
      return $this->redirectToRoute('adminNewProject');
      throw $this->createNotFoundException(
      'No product found for id '
      );
    }

    return $this->render('default/mlr1.html.twig', [
    'controller_name' => 'DefaultController',
    'formTitle' => 'Default Controller',
    'trees' => $projects,
    ]);
  }
}
