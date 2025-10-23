<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MyPageController extends AbstractController
{
    #[Route('/my/page', name: 'app_my_page')]
    public function index(): Response
    {
        return $this->render('my_page/index.html.twig', [
          'controller_name' => 'MyPageController',
          'documentTitle' => 'My Page',
        ]);
    }
}
