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

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\Form\Extension\Core\Type\SubmitType;
use       Symfony\Component\Form\Extension\Core\Type\TextType;
use       Symfony\Component\HttpFoundation\Request;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

  /**
   *  EditorController
   *
   **/

class EditorController extends AbstractController
{
  private $es;
  private $entityManager;
  private $doctrine;


  public const ICON_LOCKED            = "🔏";
  public const ICON_UNLOCKED          = "🔓";
  public const ICON_CONFIDENTIAL      = "🤐";
  public const ICON_PRIVATE           = "⛔";

  public const ICON_PERSON            = "👱";
  public const ICON_MALE              = "👨";
  public const ICON_FEMALE            = "👩";
  public const ICON_CHILD             = "👶";
  public const ICON_FAMILY            = "👪";
  public const ICON_RESEARCHERS       = "🕵️";

  public const ICON_PEDIGREE       =    "👶🔗👪";



  public const ICON_SEARCH_L          = "🔍";
  public const ICON_SEARCH_R          = "🔎";

  public const ICON_EVENTS            = "📅";
  public const ICON_NOTES             = "📝";
  public const ICON_SOURCES           = "📚";
  public const ICON_MEDIA             = "🖼️";

  public const ICON_UP                = "🔺";
  public const ICON_DOWN              = "🔻";
  public const ICON_LEFT              = "👈";
  public const ICON_RIGHT             = "👉️";

  public const ICON_LINK             = "🔗";
  public const ICON_REMOVE             = "❌";




  /**
   *  __constructor()
   *
   **/

  public function __construct(ManagerRegistry $doctrine, EditorService $es)
  {
    $this->doctrine= $doctrine;
    $this->entityManager= $doctrine->getManager();
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
   *  - primære indgang til Editor
   *
   *  TODO:
   **/

  #[Route('/editor/{url}', name: 'editor', defaults: ['p1' => null, 'p2' => null])]
  public function index(Request $request, Project $project, ?string  $p1= null, ?string $p2= null): Response
  {
    switch($project->getWorkflowPlace())
    {
      case 'import':       // Omdirigerer til en statusside for import funktionen

      case 'editor':
      case 'published':
        break;

      default:              // Videresender til en Project administrativ side...
    }


    $session= $request->getSession();

    $individual= $project->getIndividuals()->first();

    //$individual= new Individual();
    // $individual= null;
    //if ($individual->getPersonalNameStructures()->isEmpty())
    //{
    //  $this->es->newPersonalName($individual);
    //}
    $family= $project->getFamilies()->first();

    return $this->render('editor/editor.html.twig', [

      'project' => $project,
      //'indi' => null,
      'fam' => $family,
      'indi' => $individual,

    ]);
  }


  /**
   *  function newFamily()
   *
   **/

  #[Route('/editor/{url}/newfamily', name: 'editorNewFamily')]
  public function newFamily(Request $request, Project $project): Response
  {
    $fam= new Family();
    $project->addFamily($fam);


    $this->entityManager->persist($project);
    $this->entityManager->persist($fam);

    $this->entityManager->flush();
  }


  /**
   *  function newIndividual()
   *
   **/

  #[Route('/editor/{url}/newindividual', name: 'editorNewIndividual')]
  public function newIndividual(Request $request, Project $project): Response
  {
    //try
    //{
      $name= new PersonalNameStructure();
      $indi= new Individual();
      $indi->addPersonalNameStructure($name);
      $project->addIndividual($indi);

      $this->entityManager->persist($project);
      $this->entityManager->persist($indi);
      $this->entityManager->persist($name);
      $this->entityManager->flush();

      $id= $indi->getId();

      return $this->json($id);
    //}
    //catch(\Exception $e)
    //{
    //}
  }



  /**
   *  function updateFamCard
   *
   **/

  #[Route('/editor/{url}/updateFamCard', name: 'editorUpdateFamCard', methods: ['PUT'])]
  public function updateFamCard(Request $request, Project $project): Response
  {
    $data = json_decode($request->getContent(), true);


    $title= $request->getContent();

    // $family= $this->entityManager->find('App\Entity\Family', $data);

    $family= $project->getFamilies()[$data];

    return $this->render('editor/family.html.twig', [
      'title' => $title,
      //'indi' => $individual,
      'fam' => $family,

      ]);

  }




  /**
   *  function updateIndiCard
   *
   **/

  #[Route('/editor/{url}/updateIndiCard', name: 'editorUpdateIndiCard', methods: ['PUT'])]
  public function updateIndiCard(Request $request, Project $project): Response
  {
    $data = json_decode($request->getContent(), true);

    $title= $request->getContent();
    // $individual= $this->entityManager->find('App\Entity\Individual', $data);

    $individual= $project->getIndividuals()[$data];
    if ($individual->getPersonalNameStructures()->isEmpty())
    {
      $this->es->newPersonalName($individual);
    }

    return $this->render('editor/individual.html.twig', [
      'title' => $data,
      'indi' => $individual,
     ]);

  }
}
