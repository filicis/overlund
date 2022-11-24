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

use       App\Repository\SourceRepositoryCitationRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;


/**
 *  class SourceRepositoryCitation
 *
 *
 **/

#[ORM\Entity(repositoryClass: SourceRepositoryCitationRepository::class)]
class SourceRepositoryCitation
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;


  /**
   *
   *
   **/

  #[ORM\OneToMany(mappedBy: 'sourceRepositoryCitation', targetEntity: Callnumber::class, orphanRemoval: true)]
  private Collection $callnumbers;

  #[ORM\ManyToOne(inversedBy: 'citations')]
  #[ORM\JoinColumn(nullable: false)]
  private ?RepositoryRecord $repositoryRecord = null;

  #[ORM\ManyToOne(inversedBy: 'repositoryCitations')]
  #[ORM\JoinColumn(nullable: false)]
  private ?SourceRecord $sourceRecord = null;


  /**
   *
   *
   **/

  public function __construct()
  {
    $this->callnumbers = new ArrayCollection();
  }


  /**
   *
   *
   **/

  public function getId(): ?int
  {
    return $this->id;
  }

  /**
  * @return Collection<int, Callnumber>
  */
  public function getCallnumbers(): Collection
  {
    return $this->callnumbers;
  }



  /**
   *
   *
   **/

  public function addCallnumber(Callnumber $callnumber): self
  {
    if (!$this->callnumbers->contains($callnumber)) {
      $this->callnumbers->add($callnumber);
      $callnumber->setSourceRepositoryCitation($this);
    }

    return $this;
  }


  /**
   *
   *
   **/

  public function removeCallnumber(Callnumber $callnumber): self
  {
    if ($this->callnumbers->removeElement($callnumber)) {
      // set the owning side to null (unless already changed)
      if ($callnumber->getSourceRepositoryCitation() === $this) {
        $callnumber->setSourceRepositoryCitation(null);
      }
    }

    return $this;
  }

  public function getRepositoryRecord(): ?RepositoryRecord
  {
      return $this->repositoryRecord;
  }

  public function setRepositoryRecord(?RepositoryRecord $repositoryRecord): self
  {
      $this->repositoryRecord = $repositoryRecord;

      return $this;
  }

  public function getSourceRecord(): ?SourceRecord
  {
      return $this->sourceRecord;
  }

  public function setSourceRecord(?SourceRecord $sourceRecord): self
  {
      $this->sourceRecord = $sourceRecord;

      return $this;
  }
}
