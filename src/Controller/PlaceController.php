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

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use       App\Entity\PlaceRecord;
use       App\Form\PlaceRecordType;


class PlaceController extends AbstractController
{
    #[Route('/place', name: 'place')]
    public function index(): Response
    {
      $plac= new PlaceRecord();
      
      $form= $this->createForm(PlaceRecordType::class, $plac);
      
        return $this->renderForm('card.html.twig', [
            'form' => $form,
            'formTitle' => 'Ny location'
        ]);
 
      
        return $this->render('place/index.html.twig', [
            'controller_name' => 'PlaceController',
        ]);
    }
}
