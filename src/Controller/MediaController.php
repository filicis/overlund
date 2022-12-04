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
use       Symfony\Component\HttpFoundation\Response;
use       Symfony\Component\HttpFoundation\BinaryFileResponse;
use       Symfony\Component\Routing\Annotation\Route;

use       App\Entity\MediaElement;

/**
 *  class MediaController
 */

class MediaController extends AbstractController
{
    #[Route('/media', name: 'app_media')]
    public function index(): Response
    {
        return $this->render('media/index.html.twig', [
            'controller_name' => 'MediaController',
        ]);
    }


    /**
     *  download()
     * 
     *  Med ganske få undtagelser håndteres mediefiler via MedieRecord
     */

    #[Route('/media1', name: 'app_media1')]
    public function download(): BinaryFileResponse
  {
    BinaryFileResponse::trustXSendfileTypeHeader();

    $file = '/home/michael/php/overlund/data/karen.jpg';
    $response = new BinaryFileResponse($file);
    $response->headers->set('Content-Type', 'image/jpeg');
    return $response;
  }    
}
