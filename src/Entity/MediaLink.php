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
use Symfony\Bridge\Doctrine\Types\UlidType;
use Symfony\Component\Uid\Ulid;


  /**
   *  class MediaLink
   *  - Implementerer Gedcom v7 MEDIA_LINK
   *  
   *  Linker til MediaRecord    
   *    
   **/

#[ORM\Entity(repositoryClass: MediaLinkRepository::class)]
class MediaLink
{
  #[ORM\Id]
  #[ORM\Column(type: UlidType::NAME, unique: true)]
  #[ORM\GeneratedValue(strategy: "CUSTOM")]
  #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
  private $id;


  /**
   *  getId()
   *
   **/

  public function getId(): ?Ulid
  {
    return $this->id;
  }




    /**
     *  mediaRecord
     *  - linker til en MediaRecord
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

    /**
     * 
     */

    #[ORM\ManyToOne(inversedBy: 'mediaLinks')]
    #[ORM\JoinColumn(nullable: false, onDelete: "Cascade")]
    private ?Media $media = null;


  //***************************************************************************
  //***************************************************************************
  //***************************************************************************

    /**
     *  function getMediaRecord()
     */

    public function getMediaRecord(): ?MediaRecord
    {
        return $this->mediaRecord;
    }


    /**
     *  function setMedisaRecord()
     */

    public function setMediaRecord(?MediaRecord $mediaRecord): self
    {
        $this->mediaRecord = $mediaRecord;

        return $this;
    }


    /**
     *  function getTitle() 
     */

    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     *  function setTitle()
     */

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }


    /**
     *  function getCrop() 
     */

    public function getCrop(): ?string
    {
        return $this->crop;
    }


    /**
     * function setCrop()
     */

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
