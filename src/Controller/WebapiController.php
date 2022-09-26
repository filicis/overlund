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

use       Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use       Symfony\Component\HttpFoundation\RedirectResponse;
use       Symfony\Component\HttpFoundation\Request;
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\Routing\Annotation\Route;

//use       function Symfony\Component\String\u;

use       App\Entity\Project;


  /**
   *  WebapiController
   *  - Den primære adgang til systemets Api
   *
   *  - Checker for offline system
   *  - checker for offline project
   */

class WebapiController extends AbstractController
{
  #[Route('/webapi/{method}/{project}', name: 'webapi')]
  public function webapi(Request $request, String $method= null, String $project= null): Response
  {
    try
    {
      $params = json_decode($request->getContent(), true);
      $m= $params['method'] ? $params['method'] : $method;
      $p= $params['project'] ? $params['project'] : $project;


      if (! $p)
        return $this->redirectToRoute($m, ['max' => 10]);
      else
      {
        return new RedirectResponse($this->generateUrl($m, ['url' => $p]));
      }
    }
    catch(\Exception $e)
    {
      return $this->json(['stat' => 'Error', 'Message' => $e->getMessage()]);
    }


  }




  /**
   *  function apitest()
   *
   * @return Return the Overlund version:
   */

  #[Route('/apitest', name: 'apitest')]
  public function apitest(): Response
  {
    return $this->render('webapi/index.html.twig', [
    'controller_name' => 'WebapiController',
    ]);
  }

}
