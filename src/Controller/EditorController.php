<?php

/**
 * This file is part of the Overlund package.
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2000-2022 Filicis Software
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */



namespace App\Controller;

use       App\Entity\Family;
use       App\Entity\Individual;
use       App\Entity\PersonalNameStructure;
use       App\Entity\Project;

use       App\Service\EditorService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

  /**
   *  EditorController
   *
   **/

class EditorController extends AbstractController
{
  private $es;

  /**
   *  __constructor()
   *
   **/

  public function __construct(EditorService $es)
  {
    $this->es= $es;
  }


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

    return $this->render('editor/editor.html.twig', [

      'controller_name' => 'EditorController',
      'project' => $project,

    ]);
  }


  /**
   *  function newFamily()
   *
   **/

  #[Route('/editor/{url}/newfamily', name: 'editorNewFamily')]
  public function newFamily(Request $request, Project $project, ManagerRegistry $doctrine): Response
  {
    $fam= new Family();
    $project->addFamily($fam);

    $entityManager= $doctrine->getManager();

    $entityManager->persist($project);
    $entityManager->persist($fam);

    $entityManager->flush();
  }


  /**
   *  function newIndividual()
   *
   **/

  #[Route('/editor/{url}/newindividual', name: 'editorNewIndividual')]
  public function newIndividual(Request $request, Project $project, ManagerRegistry $doctrine): Response
  {
    //try
    //{
      $name= new PersonalNameStructure();
      $indi= new Individual();
      $indi->addPersonalNameStructure($name);
      $project->addIndividual($indi);

      $entityManager= $doctrine->getManager();
      $entityManager->persist($project);
      $entityManager->persist($indi);
      $entityManager->persist($name);
      $entityManager->flush();

      return $this->json(['id' => $indi->getId(),]);
    //}
    //catch(\Exception $e)
    //{
    //}
  }
}
