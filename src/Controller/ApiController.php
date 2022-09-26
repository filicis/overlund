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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


/**
 *  ApiController
 *  - Grundlæggende api funktioner
 *
 */

#[Route('/api', name: 'api_')]
class ApiController extends AbstractController
{

  /**
  *  function apitest
  *
  */

  #[Route('/', name: 'apitest')]
  public function apitest() : Response
  {
  }




  /**
  *  function GetVersion()
  *
  * @return Return the Overlund version:
  */

  #[Route('/getVersion', name: 'getVersion')]
  public function getVersion() : JsonResponse
  {
    return $this->json(['stat' => 'Ok', 'Result' => ['Version' => '0.0.1 beta',]]);
  }
}

