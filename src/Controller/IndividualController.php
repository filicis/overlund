<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndividualController extends AbstractController
{
    #[Route('/individual', name: 'app_individual')]
    public function index(): Response
    {
        return $this->render('individual/index.html.twig', [
            'controller_name' => 'IndividualController',
        ]);
    }
}
