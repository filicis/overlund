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
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;
use       Doctrine\Persistence\ManagerRegistry;


use       App\Entity\Project;
use       App\Repository\ProjectRepository;


  /**
   *  DefaultController
   *
   *
   **/

class DefaultController extends AbstractController
{
  #[Route('/', name: 'default')]
  public function index(ManagerRegistry $doctrine): Response
  {
    $projects = $doctrine->getRepository(Project::class)->findAll();

    if (! $projects) {
      throw $this->createNotFoundException(
      'No product found for id '
      );
    }

    return $this->render('default/index.html.twig', [
    'controller_name' => 'DefaultController',
    'formTitle' => 'Default Controller',
    'trees' => $projects,
    ]);
  }
}
