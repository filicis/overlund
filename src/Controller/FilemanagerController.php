<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilemanagerController extends AbstractController
{
    #[Route('/filemanager', name: 'app_filemanager')]
    public function index(): Response
    {
        return $this->render('filemanager/index.html.twig', [
            'controller_name' => 'FilemanagerController',
        ]);
    }
}
