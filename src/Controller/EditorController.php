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

class EditorController extends AbstractController
{
  #[Route('/editor/{url}', name: 'editor')]
  public function index(Request $request, Project $project): Response
  {

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




    return $this->render('editor/index.html.twig', [

    'controller_name' => 'EditorController',
    'form' => $form,
    'form' => $form->createView(),

    ]);
  }
}
