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


use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;
use App\Repository\IndividualRepository;
use Doctrine\ORM\Mapping as ORM;

  /**
   * @ORM\Entity(repositoryClass=IndividualRepository::class)
   **/

class Individual
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)

     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="individuals")
     */
    private $project;

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
