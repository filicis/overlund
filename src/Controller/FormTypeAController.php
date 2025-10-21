<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormTypeAController extends AbstractController
{
    #[Route('/form/type/a', name: 'app_form_type_a')]
    public function index(): Response
    {
        return $this->render('form_type_a/index.html.twig', [
            'controller_name' => 'FormTypeAController',
        ]);
    }
}
