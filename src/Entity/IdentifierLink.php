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

use App\Repository\IdentifierLinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


  /**
   *  class IdentifierLink
   *
   *  Anvendes af
   *  - Family
   *  - Individual
   *  - MediaRecord
   *  - RepositoryRecord
   *  - SharedNoteRecord
   *  - SourceRecord
   *  - SubmitterRecord
   */

#[ORM\Entity(repositoryClass: IdentifierLinkRepository::class)]
class IdentifierLink
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\OneToMany(mappedBy: 'identifierLink', targetEntity: IdentifierStructure::class, orphanRemoval: true)]
  private Collection $identifierStructures;

  public function __construct()
  {
    $this->identifierStructures = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  /**
  * @return Collection<int, IdentifierStructure>
  */
  public function getIdentifierStructures(): Collection
  {
    return $this->identifierStructures;
  }

  public function addIdentifierStructure(IdentifierStructure $identifierStructure): self
  {
    if (!$this->identifierStructures->contains($identifierStructure)) {
      $this->identifierStructures->add($identifierStructure);
      $identifierStructure->setIdentifierLink($this);
    }

    return $this;
  }

  public function removeIdentifierStructure(IdentifierStructure $identifierStructure): self
  {
    if ($this->identifierStructures->removeElement($identifierStructure)) {
      // set the owning side to null (unless already changed)
      if ($identifierStructure->getIdentifierLink() === $this) {
        $identifierStructure->setIdentifierLink(null);
      }
    }

    return $this;
  }
}
