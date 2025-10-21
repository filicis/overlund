<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormidlerTypeAController extends AbstractController
{
    #[Route('/formidler/type/a', name: 'app_formidler_type_a')]
    public function index(): Response
    {
        return $this->render('formidler_type_a/index.html.twig', [
            'controller_name' => 'FormidlerTypeAController',
        ]);
    }
}
