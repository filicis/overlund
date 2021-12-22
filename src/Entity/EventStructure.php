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

use       App\Repository\EventStructureRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;

  /**
   * @ORM\Entity(repositoryClass=EventStructureRepository::class)
   **/

class EventStructure extends RecordSuperclass
{

  /**
  * @ORM\Column(type="string", length=80)
  */
  private $agency;

  /**
  * @ORM\Column(type="string", length=80)
  */
  private $religion;

  /**
  * @ORM\Column(type="string", length=80)
  */
  private $cause;

  /**
  * @ORM\Column(type="string", length=22)
  */
  private $tag;

  /**
  * @ORM\Column(type="string", length=80, nullable=true)
  */
  private $text;

  /**
  * @ORM\ManyToOne(targetEntity=PlaceRecord::class, inversedBy="eventStructures")
  */
  private $place;


  public function getAgency(): ?string
  {
    return $this->agency;
  }

  public function setAgency(string $agency): self
  {
    $this->agency = $agency;

    return $this;
  }

  public function getReligion(): ?string
  {
    return $this->religion;
  }

  public function setReligion(string $religion): self
  {
    $this->religion = $religion;

    return $this;
  }

  public function getCause(): ?string
  {
    return $this->cause;
  }

  public function setCause(string $cause): self
  {
    $this->cause = $cause;

    return $this;
  }

  public function getTag(): ?string
  {
    return $this->tag;
  }

  public function setTag(string $tag): self
  {
    $this->tag = $tag;

    return $this;
  }

  public function getText(): ?string
  {
    return $this->text;
  }

  public function setText(?string $text): self
  {
    $this->text = $text;

    return $this;
  }

  public function getPlace(): ?PlaceRecord
  {
    return $this->place;
  }

  public function setPlace(?PlaceRecord $place): self
  {
    $this->place = $place;

    return $this;
  }
}
