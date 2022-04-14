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

use App\Entity\Family;
use App\Entity\Individual;
use App\Entity\Project;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;


class EditorController extends AbstractController
{
  /**
   *  Default Editor
   *  - Hvis projectlisten er tom oprettes et standard project
   *  - Er der flere projecter i listen får brugeren mulighed for at vælge project
   *
   **/ 

  #[Route('/editor', name: 'defaultEditor')]
  public function index1(Request $request) : Response
  {
    return $this->redirectToRoute('editor', ['url' => 'Project01']);
  }  



  /**
   *  index
   *
   **/

  #[Route('/editor/{url}', name: 'editor', defaults: ['p1' => null, 'p2' => null])]
  public function index(Request $request, Project $project, ?string  $p1= null, ?string $p2= null): Response
  {
    $session= $request->getSession();

    $family= null;
    $individual= null;

        $form= $this->createFormBuilder($project)
      -> add('title', TextType::class)
      -> add('url', TextType::class)
      ->add('save', SubmitType::class, ['label' => 'Create Task'])
      ->getForm();

    $form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
		  try
		  {

			  return $this->redirectToRoute('/da');
      }
      catch(\Exception $e)
      {
      }
		}

    return $this->render('editor/editor.html.twig', [

      'controller_name' => 'EditorController',
      'project' => $project,
    'form' => $form,
    'form' => $form->createView(),

    ]);
  }


  /**
   *
   *
   **/

  #[Route('/editor/{url}/newfamily', name: 'editorNewFamily')]
  public function newFamily(Request $request, Project $project, ManagerRegistry $doctrine): Response
  {
    $fam= new Family();
    $project->addFamily($fam);

    	//	  try
		  //{
        $entityManager= $doctrine->getManager();

              // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($project);
        $entityManager->persist($fam);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

			  //return $this->redirectToRoute('editor', ['url' => 'familie']);
      //}
      //catch(\Exception $e)
      //{
      //}
			//return $this->redirectToRoute('editor', ['url' => 'familie' ]);


  }


  /**
   *
   *
   **/

  #[Route('/editor/{url}/newindividual', name: 'editorNewIndividual')]
  public function newIndividual(Request $request, Project $project, ManagerRegistry $doctrine): Response
  {
    $indi= new Individual();
    $project->addIndividual($indi);

    		  try
		  {
        $entityManager= $doctrine->getManager();

              // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($project);
        $entityManager->persist($indi);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

			  return $this->redirectToRoute('editor', ['url' => 'familie' ]);
      }
      catch(\Exception $e)
      {
      }
			// return $this->redirectToRoute('editor', ['url' => 'familie' ]);


  }

}
