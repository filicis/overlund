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

use       App\Repository\MediaLinkRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\Traits\UlidIdTrait;

  /**
   * @ORM\Entity(repositoryClass=MediaLinkRepository::class)
   **/

class MediaLink
{
  use UlidIdTrait;


    /**
     * @ORM\ManyToOne(targetEntity=MediaRecord::class, inversedBy="mediaLinks")
     */
    private $mediaRecord;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $crop;

    /**
     * @ORM\ManyToOne(targetEntity=Record::class, inversedBy="mediaLinks")
     */
    private $record;


    public function getMediaRecord(): ?MediaRecord
    {
        return $this->mediaRecord;
    }

    public function setMediaRecord(?MediaRecord $mediaRecord): self
    {
        $this->mediaRecord = $mediaRecord;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCrop(): ?string
    {
        return $this->crop;
    }

    public function setCrop(?string $crop): self
    {
        $this->crop = $crop;

        return $this;
    }

    public function getRecord(): ?Record
    {
        return $this->record;
    }

    public function setRecord(?Record $record): self
    {
        $this->record = $record;

        return $this;
    }
}
