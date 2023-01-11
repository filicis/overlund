<?php

namespace App\Controller;

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\HttpFoundation\Request;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;

use       App\Entity\Project;
use       App\Form\SourceLibraryType;

class SourceRecordController extends AbstractController {

    #[ Route( '/source/record', name: 'app_source_record' ) ]

    public function index(): Response {
        return $this->render( 'source_record/index.html.twig', [
            'controller_name' => 'SourceRecordController',
        ] );
    }

    #[ Route( '/source/library/{url}', name: 'app_source_library' ) ]

    public function sourceLibrary( Request $request, Project $project ): Response {

        $form = $this->createForm( SourceLibraryType::class, $project );

        return $this->render( 'source_record/index.html.twig', [
            'controller_name' => 'SourceRecordController',
            'form' => $form,
        ] );
    }

}
