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

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\HttpFoundation\Request;
use       Symfony\Component\Routing\Annotation\Route;

use       Symfony\Component\Form\Extension\Core\Type\TextType;

use       Doctrine\Persistence\ManagerRegistry;

use       App\Entity\Project;
use       App\Entity\RepositoryRecord;
use       App\Entity\AddressStructure;
use       App\Form\RepositoryRecordType;

class RepositoryController extends AbstractController {

    /**
    *  function library
    */

    #[ Route( '/repository/{url}', name: 'app_repository' ) ]

    public function index( Project $project ): Response {
        return $this->render( 'repository/library.html.twig', [
            'project' => $project,
            'controller_name' => 'RepositoryController',
        ] );
    }

    /**
    *
    */

    #[ Route( '/newrepository/{url}', name: 'newrepository' ) ]

    public function new( Request $request, Project $project, ManagerRegistry $doctrine ): Response {
        $record = new RepositoryRecord();

        $form = $this->createForm( RepositoryRecordType::class, $record );

        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {
            try {
                $entityManager = $doctrine->getManager();

                // tell Doctrine you want to ( eventually ) save the Product ( no queries yet )
                $entityManager->persist( $record );

                // actually executes the queries ( i.e. the INSERT query )
                $entityManager->flush();

                //return $this->redirectToRoute( '/da' );
            } catch( \Exception $e ) {
            }
        }

        return $this->render( 'editor/modal/repository1.html.twig', [
            'form' => $form,
            'project' => $project,
            'controller_name' => 'ProjectController',
        ] );

    }

}
