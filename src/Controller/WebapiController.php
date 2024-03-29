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
use       Psr\Log\LoggerInterface;

use       Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use       Symfony\Component\HttpKernel\Exception\BadRequestException;
use       Symfony\Component\HttpKernel\Exception\NotImplementedException;

use       Symfony\Component\Routing\Exception\RouteNotFoundException;

//use       function Symfony\Component\String\u;

use       App\Entity\Project;


  /**
   *  WebapiController
   *  - Den primære snitflade til systemets Api
   *  - Opdelt i to indgange: /webapi der anvendes intern i systemet og /api der åbner for kommunikation til andre applikationer
   *
   *  - Checker for offline system
   *  - checker for offline project
   */

class WebapiController extends AbstractController
{
  private $logger= null;

  /**
   *  function __construct
   */

  public function __construct(LoggerInterface $logger)
  {
    $this->logger= $logger;
  }


  /**
   * function webapi
   * - Snitflade til anvendelse internt i systemet
   *
   * Ved fejl returneres en taktfuld Json fejlmeddelse
   */

  #[Route('/webapi/{method}/{project}', name: 'webapi')]
  public function webapi(Request $request, String $method= null, String $project= null): Response
  {
    $offline= false;

    if ($offline)
      throw new ServiceUnavailableHttpException();


    try
    {
      $params = json_decode($request->getContent(), true);
      $m= $params['method'] ? $params['method'] : $method;
      $p= $params['project'] ? $params['project'] : $project;

      //$this->logger->info('Method: ' . $m);
      //$this->logger->info('Project: ' . $p);


      if (! $p)
        return $this->redirectToRoute($m, ['max' => 10]);
      else
      {
        return new RedirectResponse($this->generateUrl($m, ['url' => $p]));
      }

    }
    catch(RouteNotFoundException $e)
    {
      // $this->logger->error('Route not found: ' . $e->getMessage());
      //return $this->json(['stat' => 'Error', 'Message' => 'Metode ikke implementeret: ' . $m]);
      return $response = new Response('Hello World', 501);
    }
    catch(\Exception $e)
    {
      return $this->json(['stat' => 'Error', 'Message' => 'Webapi fejl: ' . $e->getMessage()]);
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
