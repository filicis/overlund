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

use       App\Entity\RecordSuperclass;

  /**
   * @ORM\Entity(repositoryClass=PlaceRecordRepository::class)
   * @ORM\Table(indexes={@ORM\Index(name="search_idx", columns={"place", })})
   **/

class PlaceRecord extends RecordSuperclass
{

  /**
   * @ORM\Column(type="string", length=255)
   **/

  private $place;

  /**
   * @ORM\Column(type="string", length=80, nullable=true)
   **/

  private $map;

  /**
   * @ORM\OneToMany(targetEntity=EventStructure::class, mappedBy="place")
   */
  private $eventStructures;

  /**
   * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="placeRecords")
   */
  private $project;

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

  public function getMap(): ?string
  {
    return $this->map;
  }

  public function setMap(?string $map): self
  {
    $this->map = $map;

    return $this;
  }

  /**
   * @return Collection|EventStructure[]
   */
  public function getEventStructures(): Collection
  {
      return $this->eventStructures;
  }

  public function addEventStructure(EventStructure $eventStructure): self
  {
      if (!$this->eventStructures->contains($eventStructure)) {
          $this->eventStructures[] = $eventStructure;
          $eventStructure->setPlace($this);
      }

      return $this;
  }

  public function removeEventStructure(EventStructure $eventStructure): self
  {
      if ($this->eventStructures->removeElement($eventStructure)) {
          // set the owning side to null (unless already changed)
          if ($eventStructure->getPlace() === $this) {
              $eventStructure->setPlace(null);
          }
      }

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
}
