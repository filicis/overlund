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

use App\Repository\RepositoryRecordRepository;
use Doctrine\ORM\Mapping as ORM;

  /**
   * @ORM\Entity(repositoryClass=RepositoryRecordRepository::class)
   **/

class RepositoryRecord
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   **/

  private $id;

  /**
   * @ORM\Column(type="string", length=255)
   **/

  private $repo;

  /**
   * @ORM\Column(type="string", length=255)
   **/

  private $name;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getRepo(): ?string
  {
    return $this->repo;
  }

  public function setRepo(string $repo): self
  {
    $this->repo = $repo;

    return $this;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }
}
