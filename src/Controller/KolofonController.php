<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class KolofonController extends AbstractController
{
    #[Route('/kolofon', name: 'app_kolofon')]
    public function index(): Response
    {
        return $this->render('kolofon/index.html.twig', [
            'controller_name' => 'KolofonController',
        ]);
    }
}
