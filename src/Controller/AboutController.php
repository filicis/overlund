<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Individual;

class AboutController extends AbstractController
{


    /**
     *
     * @Route("/about", name="about")
     **/

    public function index(): Response
    {
      $item= new Individual();

        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
            'test' => $item,
        ]);
    }
}
