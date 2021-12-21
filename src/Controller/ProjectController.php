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

use       App\Entity\Project;
use       App\Form\ProjectType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;

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
  public function new(Request $request, ManagerRegistry $doctrine): Response
  {
    $project= new Project();

    $form= $this->createFormBuilder($project)
      -> add('title', TextType::class)
      -> add('url', TextType::class)
      ->getForm();

    $form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
		  try
		  {
        $entityManager= $doctrine->getManager();

              // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($project);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

			  return $this->redirectToRoute('/da');
      }
      catch(\Exception $e)
      {
      }
		}



    return $this->render('project/newProject.html.twig', [
    'form' => $form,
    'form' => $form->createView(),
    'formTitle' => 'Create New Project',
    'controller_name' => 'ProjectController',
    ]);
  }


  /**
   *
   **/

  #[Route('/admin/openProject', name: 'adminOpenProject')]
  public function open(Request $request, ManagerRegistry $doctrine) : Response
  {
    $projecter= $doctrine->getRepository(Project::class)->findAll();

    $form= $this->createFormBuilder($projecter)
      -> add('project', CollectionType::class, ['entry_type' => Text::class])
      -> getForm();
    ;  

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {
    }
    return $this->render('card.html.twig', [
      'form' => $form,
      'form' => $form->createView(),
      'formTitle' => 'Select Project'
      ]);  
  }  

}
