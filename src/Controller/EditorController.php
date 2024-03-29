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

use       App\Form\IndividualType;
use       App\Form\FamilyType;

use       App\Service\EditorService;

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\Form\Extension\Core\Type\SubmitType;
use       Symfony\Component\Form\Extension\Core\Type\TextType;
use       Symfony\Component\HttpFoundation\Request;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;

use       Ds\Set;

use       Doctrine\Persistence\ManagerRegistry;

/**
*  EditorController
*
**/

class EditorController extends AbstractController {

    private $es;
    private $entityManager;
    private $doctrine;

    /**
    *  function __constructor()
    *
    **/

    public function __construct( ManagerRegistry $doctrine, EditorService $es ) {
        $this->doctrine = $doctrine;
        $this->entityManager = $doctrine->getManager();
        $this->es = $es;
    }

    /**
    *  Default Editor
    *  - Hvis projectlisten er tom oprettes et standard project
    *  - Er der flere projecter i listen får brugeren mulighed for at vælge project
    *
    **/

    #[ Route( '/editor', name: 'defaultEditor' ) ]

    public function index1( Request $request ) : Response {
        return $this->redirectToRoute( 'editor', [ 'url' => 'project01' ] );
    }

    /**
    *  index
    *  - primære indgang til Editor
    *
    *  TODO:
    **/

    #[ Route( '/editor/{url}', name: 'editor', defaults: [ 'p1' => null, 'p2' => null ] ) ]

    public function index( Request $request, Project $project, ?string  $p1 = null, ?string $p2 = null ): Response {
        switch( $project->getWorkflowPlace() ) {
            case 'import':       // Omdirigerer til en statusside for import funktionen

            case 'editor':
            case 'published':
            break;

            default:              // Videresender til en Project administrativ side...
        }

        $session = $request->getSession();

        $individual = $project->getIndividuals()->first();
        $indiform = $this->createForm( IndividualType::class, $individual );

        $family = $project->getFamilies()->first();
        $famform = $this->createForm( FamilyType::class, $family );

        return $this->render( 'editor/editor.html.twig', [

            'project' => $project,
            'fam' => $family,
            'indi' => $individual,
            'indiform' => $indiform,
            'famform' => $famform,

        ] );
    }

    /**
    *  function updateFamCard
    *
    *  TODO: skal opdatere FamHistory i session.
    **/

    #[ Route( '/editor/{url}/updateFamCard', name: 'editorUpdateFamCard', methods: [ 'PUT' ] ) ]

    public function updateFamCard( Request $request, Project $project ): Response {
        $data = json_decode( $request->getContent(), true );
        $session = $request->getSession();
        $set = $session->get( 'FamHistory' );
        if ( !$set )
        $set = new Set();
        $set->add( $data );
        $session->set( 'FamHistory', $set );

        $title = $request->getContent();

        $family = $project->getFamilies()[ $data ];
        $famform = $this->createForm( FamilyType::class, $family );

        //$family = $project->getFamilies()->first();

        return $this->render( 'editor/family.html.twig', [
            'title' => $title,
            'project' => $project,
            'fam' => $family,
            'famform' => $famform,

        ] );

    }

    /**
    *  function updateIndiCard
    *
    **/

    #[ Route( '/editor/{url}/updateIndiCard', name: 'editorUpdateIndiCard', methods: [ 'PUT' ] ) ]

    public function updateIndiCard( Request $request, Project $project ): Response {
        $data = json_decode( $request->getContent(), true );
        $session = $request->getSession();
        $set = $session->get( 'IndiHistory' );
        if ( !$set )
        $set = new Set();
        $set->add( $data );
        $session->set( 'IndiHistory', $set );

        $title = $request->getContent();

        $individual = $project->getIndividuals()[ $data ];
        $indiform = $this->createForm( IndividualType::class, $individual );

        if ( $individual->getNames()->isEmpty() ) {
            $this->es->newPersonalName( $individual );
        }

        return $this->render( 'editor/individual.html.twig', [
            'title' => $data,
            'project' => $project,
            'indi' => $individual,
            'indiform' => $indiform,
        ] );

    }
}
