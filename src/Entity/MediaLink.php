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




namespace App\Entity;

use       App\Repository\MediaLinkRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\Traits\UlidIdTrait;

  /**
   *  class MediaLink
   **/

#[ORM\Entity(repositoryClass: MediaLinkRepository::class)]
class MediaLink
{
  use UlidIdTrait;


    /**
     *  mediaRecord
     *  - linker til en MediaRedor
     */

    #[ORM\ManyToOne(targetEntity: MediaRecord::class, inversedBy: "mediaLinks")]
    #[ORM\JoinColoumn(onDelete: "Cascade")]
    private $mediaRecord;

    /**
     */

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $title;

    /**
     */

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private $crop;

    #[ORM\ManyToOne(inversedBy: 'mediaLinks')]
    #[ORM\JoinColumn(nullable: false, onDelete: "Cascade")]
    private ?Media $media = null;

    /**
     */



  //***************************************************************************
  //***************************************************************************
  //***************************************************************************

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

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(?Media $media): self
    {
        $this->media = $media;

        return $this;
    }

}
