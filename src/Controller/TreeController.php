<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TreeController extends AbstractController
{
    #[Route('/tree', name: 'app_tree')]
    public function index(): Response
    {
        return $this->render('tree/index.html.twig', [
            'controller_name' => 'TreeController',
            'documentTitle' => 'Offentlige slægtstræer',
                ]);
    }
}
