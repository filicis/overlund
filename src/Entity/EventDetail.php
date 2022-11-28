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

use       App\Repository\EventDetailRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\Traits\AddressTrait;
use       App\Entity\Traits\Restrictions;

#[ORM\Entity(repositoryClass: EventDetailRepository::class)]
class EventDetail
{
  use AddressTrait, Restrictions;

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 32)]
  private ?string $tag = null;

  /**
   *  agency
   *  - Implementerer Gedcom v7 AGNC tag
   * 
   *   
   */

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $agency = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $religion = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $cause = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $date = null;


  //***************************************************************************
  //***************************************************************************
  //***************************************************************************


  /**
   *
   *
   */

  public function __construct()
  {
  }


  public function getId(): ?int
  {
    return $this->id;
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

  public function getAgency(): ?string
  {
      return $this->agency;
  }

  public function setAgency(?string $agency): self
  {
      $this->agency = $agency;

      return $this;
  }

  public function getReligion(): ?string
  {
      return $this->religion;
  }

  public function setReligion(?string $religion): self
  {
      $this->religion = $religion;

      return $this;
  }

  public function getCause(): ?string
  {
      return $this->cause;
  }

  public function setCause(?string $cause): self
  {
      $this->cause = $cause;

      return $this;
  }

  public function getDate(): ?string
  {
      return $this->date;
  }

  public function setDate(?string $date): self
  {
      $this->date = $date;

      return $this;
  }


}
