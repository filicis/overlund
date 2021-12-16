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

use App\Repository\MediaRecordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediaRecordRepository::class)
 */
class MediaRecord extends RecordSuperclass
{
  protected const XREF_PREFIX = 'M';

  /**
   * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="mediaRecords")
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
