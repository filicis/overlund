<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserRegistrationRequestController extends AbstractController
{
    #[Route('/user', name: 'app_user_registration_request')]
    public function index(): Response
    {
        return $this->render('user_registration_request/index.html.twig', [
            'controller_name' => 'UserRegistrationRequestController',
            'documentTitle' => 'Anmodning om brugerregistrering', 
        ]);
    }
}
