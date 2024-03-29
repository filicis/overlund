<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/


namespace App\Entity\Traits;

use 			Doctrine\ORM\Mapping as ORM;

use       Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use       Symfony\Component\Uid\Ulid;


  /**
   *  UlidIdTrait
   *
   **/

trait UlidIdTrait
{
  #[ORM\Id]
  #[ORM\Column(type: "ulid", unique: true)]
  #[ORM\GeneratedValue(strategy: "CUSTOM")]
  #[ORM\CustomIdGenerator(class: UlidGenerator::class)]
  private $id;


  /**
   *  getId()
   *
   **/

  public function getId(): ?Ulid
  {
    return $this->id;
  }



}

