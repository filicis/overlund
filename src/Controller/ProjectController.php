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
use       App\Form\ProjectsType;
use	  App\Form\GedcomImportType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use       Doctrine\Persistence\ManagerRegistry;
use       Doctrine\ORM\ORMException;

use       Psr\Log\LoggerInterface;

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

    /*
    $form= $this->createFormBuilder($project)
      -> add('title', TextType::class)
      -> add('url', TextType::class)
      ->getForm();
    */

    $form= $this->createForm(ProjectType::class, $project);

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



    return $this->renderForm('project/newProject.html.twig', [
    'form' => $form,
    'formTitle' => 'Create New Project',
    'controller_name' => 'ProjectController',
    ]);
  }


  /**
   *  openProject()
   **/

  #[Route('/admin/openProject', name: 'adminOpenProject')]
  public function open(Request $request, ManagerRegistry $doctrine) : Response
  {
    $projecter= $doctrine->getRepository(Project::class)->findAll();


    $form= $this->createFormBuilder($projecter)
      -> add('project', EntityType::class, ['class' => Project::class, 'multiple' => false, 'expanded' => false, 'help' => 'Hjælpetekst'])
      -> getForm();
    ;


    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {
      return $this->redirectToRoute('editor', ['url' => $form->get('project')->getData()->getUrl()]);
    }
    return $this->renderForm('card.html.twig', [
      'form' => $form,
      'formTitle' => 'Select Project'
      ]);
  }

  /**
   *  import
   *  - Importerer en Gedcom fil til det aktuelle project
   **/

  #[Route('/editor/{url}/import', name: 'editorImport')]
  public function import(Request $request, Project $project, ManagerRegistry $doctrine): Response
  {
    $form= $this->createForm(GedcomImportType::class, $project);
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
      return $this->redirectToRoute('editor', ['url' => $project->getUrl()]);

    }
     return $this->renderForm('card.html.twig', [
       'form' => $form,
       'formTitle' => 'Import GEDCOM file',
       'warning' => 'The will delete all the genealogy data and replace with data from a GEDCOM file',
     ]);

  }

  /**
   *  import1
   *  - Importerer en Gedcom fil til det aktuelle project
   *
   *  - Her dropper vi Symfony Forms til fordel for ren javascript løsning med Filereader, Formdata og Fetch
   **/

  #[Route('/editor/{url}/import1', name: 'editorImport1')]
  public function import1(Request $request, Project $project, ManagerRegistry $doctrine, LoggerInterface $logger): Response
  {
    $defaultData = ['message' => 'Type your message here'];
    $form= $this->createFormBuilder($defaultData)
      // -> add('filename', FileType::class, ['allow_file_upload' => true])
      //-> add('preview', TextareaType::class, ['attr' => ['data-gedcom-target' => 'preview holger']])
      //-> add('knap', SubmitType::class)
      -> getForm();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
      try
      {
        $data= $form->getData();



        $logger->error("Helloo there !");

        $logger->error(count($data));

        $logger->error(array_key_first($data));


        /*
        foreach($data as [$key, $item])
        {
          $logger->error($key);
        }
        */
      }
      catch(\Exception $e)
      {
      }
      //return $this->redirectToRoute('editor', ['url' => $project->getUrl()]);

    }
     return $this->renderForm('editor/import.html.twig', [
       'myform' => $form,
       'formTitle' => 'Import GEDCOM file',
       'warning' => 'The will delete all the genealogy data and replace with data from a GEDCOM file',
     ]);

  }



}
