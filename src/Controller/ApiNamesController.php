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
use Symfony\Component\HttpFoundation\JsonRespone;
use Symfony\Component\Routing\Annotation\Route;

/**
 *  ApiNamesController
 *  - Grundlæggende api funktioner
 *
 */ 

#[Route('/api/names', name: 'api_names_')]
class ApiNamesController extends AbstractController
{
    #[Route('/webapi', name: 'app_webapi')]
    public function index(): Response
    {
        return $this->render('webapi/index.html.twig', [
            'controller_name' => 'WebapiController',
        ]);
    }

    /**
     *  function GetVersion()
     *
     * @return Return the Overlund version:
     */ 

    #[Route('/getVersion', name: 'getVersion')]
    public function getVersion() : Response
    {
      return $this->json(['Version' => '0.0.1 beta',], $status= 200, $headers= [], $context= []);
    }  
}
