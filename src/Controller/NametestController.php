<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\NameStructure;
use App\Form\NamePiecesType;
use App\Form\NameStructureType;

/**
*  NametestController
*/

class NametestController extends AbstractController {

    #[ Route( '/nametest', name: 'app_nametest' ) ]

    public function index(): Response {
        $nameStructure = new NameStructure();

        $form = $this->createFormBuilder( $nameStructure )
        ->add( 'personalName', TextType::class, [ 'label' => 'Personal Name' ] )
        ->add( 'nameType', TextType::class, [ 'label' => 'Nametype' ] )
        //->add( 'save', SubmitType::class, [ 'label' => 'Submit' ] )
        ->add( 'namePieces', NamePiecesType::class )
        //->add( 'nameStructure', NameStructureType::class )
        ->getForm();

        return $this->render( 'nametest/index.html.twig', [
            'controller_name' => 'NametestController',
            'form' => $form,
        ] );
    }
}
