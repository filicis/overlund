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
use       App\Form\AddressType;

class RepositoryController extends AbstractController {
    #[ Route( '/repository', name: 'app_repository' ) ]

    public function index(): Response {
        return $this->render( 'repository/index.html.twig', [
            'controller_name' => 'RepositoryController',
        ] );
    }

    /**
    *
    */

    #[ Route( '/newrepository/{url}', name: 'newrepository' ) ]

    public function new( Request $request, Project $project, ManagerRegistry $doctrine ): Response {
        $record = new RepositoryRecord();

        /*
        $form = $this->createFormBuilder( $record )
        ->add( 'name', TextType::class )
        ->add( 'addr', TextType::class )
        ->add( 'adr1', TextType::class )
        ->add( 'adr2', TextType::class )
        ->add( 'adr3', TextType::class )

        ->add( 'post', TextType::class )
        ->add( 'city', TextType::class )
        ->add( 'stae', TextType::class )
        ->add( 'ctry', TextType::class )
        ->add( 'phon', TextType::class )
        ->add( 'email', TextType::class )
        ->add( 'fax', TextType::class )
        ->add( 'www', TextType::class )
        ->getForm();
        */

        $form = $this->createForm( AddressType::class, $record );

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

        return $this->renderForm( 'editor/modal/repository1.html.twig', [
            'form' => $form,
            'project' => $project,
            'controller_name' => 'ProjectController',
        ] );

    }

}
