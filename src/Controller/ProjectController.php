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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

  /**
   *  ProjectController
   *  - Indeholder alle system administrative funktioner omkring projecter
   *
   **/

class ProjectController extends AbstractController
{
  #[Route('/admin/project', name: 'adminProject')]
  public function index(): Response
  {
    return $this->render('project/index.html.twig', [
    'controller_name' => 'ProjectController',
    ]);
  }



    /**
     *  new
     *
     **/

  #[Route('/admin/newProject', name: 'adminNewProject')]
  public function new(Request $request): Response
  {
    $project= new Project();

    $form= $this->createFormBuilder($project)
      -> add('title', TextType::class)
      -> add('url', TextType::class)
      ->add('save', SubmitType::class, ['label' => 'Create Task'])
      ->getForm();

    $form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{


			return $this->redirectToRoute('editor');


		}



    return $this->render('project/newProject.html.twig', [
    'form' => $form,
    'form' => $form->createView(),
    'controller_name' => 'ProjectController',
    ]);
  }




}
