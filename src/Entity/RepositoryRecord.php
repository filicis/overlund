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

use       App\Repository\RepositoryRecordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;
use       App\Entity\Traits\AddressTrait;


/**
 *  Class RepositoryRecord
 *
 *  Implementerer Gedcom v7 REPOSITORY_RECORD
 *  - https://gedcom.io/terms/v7/record-REPO
 *
 **/

#[ORM\Entity(repositoryClass: RepositoryRecordRepository::class)]
class RepositoryRecord extends RecordSuperclass
{
  use AddressTrait;

  protected const XREF_PREFIX = 'R';

  /**
   *  name
   *
   *  - https://gedcom.io/terms/v7/NAME
   **/

  #[ORM\Column(type: "string", length: 255)]
  private $name;

  #[ORM\OneToMany(mappedBy: 'repositoryRecord', targetEntity: SourceRepositoryCitation::class, orphanRemoval: true)]
  private Collection $citations;

  public function __construct()
  {
      parent::__construct();
      $this->citations = new ArrayCollection();
  }


  /**
   *
   **/

  public function getName(): ?string
  {
    return $this->name;
  }


  /**
   *
   **/

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  /**
   * @return Collection<int, SourceRepositoryCitation>
   */
  public function getCitations(): Collection
  {
      return $this->citations;
  }

  public function addCitation(SourceRepositoryCitation $citation): self
  {
      if (!$this->citations->contains($citation)) {
          $this->citations->add($citation);
          $citation->setRepositoryRecord($this);
      }

      return $this;
  }

  public function removeCitation(SourceRepositoryCitation $citation): self
  {
      if ($this->citations->removeElement($citation)) {
          // set the owning side to null (unless already changed)
          if ($citation->getRepositoryRecord() === $this) {
              $citation->setRepositoryRecord(null);
          }
      }

      return $this;
  }
}
