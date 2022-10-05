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

use       App\Repository\PlaceRecordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;

use       Symfony\Component\Validator\Constraints as Assert;

use       App\Entity\RecordSuperclass;

  /**
   * @ORM\Entity(repositoryClass=PlaceRecordRepository::class)
   * @ORM\Table(indexes={@ORM\Index(name="search_idx", columns={"place", })})
   **/

#[ORM\Entity(repositoryClass: PlaceRecordRepository::class)]
// # [ORM\Table(indexes: {@ORM\Index(name: "search_idx", columns: {"place", })})]
class PlaceRecord extends RecordSuperclass
{

  /**
   * @ORM\Column(type="string", length=255)
   **/

  #[ORM\Column(type: "string", length: 255)]
  private $place;



  /**
   */

  #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "placeRecords")]
  private $project;

  /**
   *
   *  @Assert\Regex(pattern= "^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)$", message="Ingen tal")
   *  @ORM\Column(type="string", length=30, nullable=true)
   */

  #[ORM\Column(type: "string", length: 30, nullable: true)]
  private $latitude;

  /**
   *  @Assert\Regex(pattern= "^[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$")
   *  @ORM\Column(type="string", length=30, nullable=true)
   */

  #[ORM\Column(type: "string", length: 30, nullable: true)]
  private $longitude;

  public function __construct()
  {
      $this->eventStructures = new ArrayCollection();
  }


  public function getPlace(): ?string
  {
    return $this->place;
  }

  public function setPlace(string $place): self
  {
    $this->place = $place;

    return $this;
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

  public function getLatitude(): ?string
  {
      return $this->latitude;
  }

  public function setLatitude(?string $latitude): self
  {
      $this->latitude = $latitude;

      return $this;
  }

  public function getLongitude(): ?string
  {
      return $this->longitude;
  }

  public function setLongitude(?string $longitude): self
  {
      $this->longitude = $longitude;

      return $this;
  }
}
