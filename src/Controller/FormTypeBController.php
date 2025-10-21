<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormTypeBController extends AbstractController
{
    #[Route('/form/type/b', name: 'app_form_type_b')]
    public function index(): Response
    {
        return $this->render('form_type_b/index.html.twig', [
            'controller_name' => 'FormTypeBController',
        ]);
    }
}
