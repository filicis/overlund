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

use App\Repository\RecordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

  /**
   * @ORM\Entity(repositoryClass=RecordRepository::class)
   **/
class Record
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

    /**
     * @ORM\ManyToMany(targetEntity=NoteRecord::class, inversedBy="records")
     */
    private $noteRecords;

    public function __construct()
    {
        $this->indentifierStructure = new ArrayCollection();
        $this->noteRecords = new ArrayCollection();
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
            $indentifierStructure->setRecord($this);
        }

        return $this;
    }

    public function removeIndentifierStructure(IdentifierStructure $indentifierStructure): self
    {
        if ($this->indentifierStructure->removeElement($indentifierStructure)) {
            // set the owning side to null (unless already changed)
            if ($indentifierStructure->getRecord() === $this) {
                $indentifierStructure->setRecord(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NoteRecord[]
     */
    public function getNoteRecords(): Collection
    {
        return $this->noteRecords;
    }

    public function addNoteRecord(NoteRecord $noteRecord): self
    {
        if (!$this->noteRecords->contains($noteRecord)) {
            $this->noteRecords[] = $noteRecord;
        }

        return $this;
    }

    public function removeNoteRecord(NoteRecord $noteRecord): self
    {
        $this->noteRecords->removeElement($noteRecord);

        return $this;
    }
}
