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

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;


  /**
   *  Udviklings controller
   *  - til afprøvning af nye ideer
   *
   **/
   
use       App\Entity\PersonalNameStructure;
use       App\Form\PersonalNameStructureType;

class DevController extends AbstractController
{
    #[Route('/dev', name: 'dev')]
    public function index(): Response
    {
      $name= new PersonalNameStructure();
      
      $form= $this->createForm(PersonalNameStructureType::class, $name);
      
        return $this->renderForm('card.html.twig', [
            'form' => $form,
            'formTitle' => 'Udfyld navn'
        ]);
    }
}
