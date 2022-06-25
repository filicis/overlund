<?php

/**
 * This file is part of the Overlund package.
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2000-2022 Filicis Software
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *  ApiProjectsController
 *  - Grundlæggende api funktioner
 *
 */ 

#[Route('/api/projects', name: 'api_projects_')]
class ApiProjectsController extends AbstractController
{
    #[Route('/webapi', name: 'webapi')]
    public function index(): Response
    {
        return $this->render('webapi/index.html.twig', [
            'controller_name' => 'WebapiController',
        ]);
    }

    /**
     *  function GetList()
     *
     * @return Return the Overlund version:
     */ 

    #[Route('/getList', name: 'getList')]
    public function getVersion() : Response
    {
      return $this->json(['svar' => 'yes',]);
    }  
}
