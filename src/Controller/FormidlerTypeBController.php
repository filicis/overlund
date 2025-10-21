<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormidlerTypeBController extends AbstractController
{
    #[Route('/formidler/type/b', name: 'app_formidler_type_b')]
    public function index(): Response
    {
        return $this->render('formidler_type_b/index.html.twig', [
            'controller_name' => 'FormidlerTypeBController',
        ]);
    }
}
