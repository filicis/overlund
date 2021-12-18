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

use App\Repository\RecordLinksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

  /**
   * @ORM\Entity(repositoryClass=RecordLinksRepository::class)
   **/
class RecordLinks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     **/

    private $id;

    /**
     * @ORM\OneToMany(targetEntity=IdentifierStructure::class, mappedBy="recordLinks")
     */

    private $indentifierStructure;

    public function __construct()
    {
        $this->indentifierStructure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|IdentifierStructure[]
     */
    public function getIndentifierStructure(): Collection
    {
        return $this->indentifierStructure;
    }

    public function addIndentifierStructure(IdentifierStructure $indentifierStructure): self
    {
        if (!$this->indentifierStructure->contains($indentifierStructure)) {
            $this->indentifierStructure[] = $indentifierStructure;
            $indentifierStructure->setRecordLinks($this);
        }

        return $this;
    }

    public function removeIndentifierStructure(IdentifierStructure $indentifierStructure): self
    {
        if ($this->indentifierStructure->removeElement($indentifierStructure)) {
            // set the owning side to null (unless already changed)
            if ($indentifierStructure->getRecordLinks() === $this) {
                $indentifierStructure->setRecordLinks(null);
            }
        }

        return $this;
    }
}
