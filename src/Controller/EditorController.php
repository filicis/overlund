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

class EditorController extends AbstractController
{
  #[Route('/editor/{url}', name: 'editor')]
  public function index(Project $project): Response
  {
    return $this->render('editor/index.html.twig', [
    'controller_name' => 'EditorController',
    ]);
  }
}
