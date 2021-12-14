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

use       App\Repository\SubmitterRecordRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;
use       App\Entity\Traits\AddressTrait;

  /**
   * @ORM\Entity(repositoryClass=SubmitterRecordRepository::class)
   **/

class SubmitterRecord extends RecordSuperclass
{
  use AddressTrait;

  /**
   * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="submitterRecords")
   */
  private $project;

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
