<?php


/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/



namespace App\Entity;

use App\Repository\GedcomHeadRepository;
use Doctrine\ORM\Mapping as ORM;

use       App\Entity\GedcomStructure;


#[ORM\Entity(repositoryClass: GedcomHeadRepository::class)]
class Gedc extends GedcomStructure
{

}

