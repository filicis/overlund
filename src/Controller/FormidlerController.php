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

use App\Entity\Project;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

  /**
   *  class FormidlerController
   *
   **/

class FormidlerController extends AbstractController
{


  /**
   *  function home()
   *
   **/

    #[Route('/tree/{url}', name: 'tree')]
    public function home(Project $project): Response
    {
        return $this->render('formidler/home.html.twig', [
            'controller_name' => 'FormidlerController',
            'project' => $project,
        ]);
    }

  /**
   *
   *
   **/

    #[Route('/tree', name: 'notree')]
    public function index1(): Response
    {
       return $this->render('formidler/index.html.twig', [
                'controller_name' => 'FormidlerController',
            ]);
    }
}
