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

use       App\Repository\RecordRepository;
use       Doctrine\Common\Collections\ArrayCollection;
use       Doctrine\Common\Collections\Collection;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\Traits\UlidIdTrait;

  /**
   *  Record
   *  - Basal funtionalitet der gÃ¥r igen i (næsten) alle Gedcom Records
   *
   *  Linker op til:
   *  - IdentifierStructure
   *  - NoteStructure
   *  - SourceCitatation
   *  - MediaLink
   * @ORM\Entity(repositoryClass=RecordRepository::class)
   **/

#[ORM\Entity(repositoryClass: RecordRepository::class)]
class Record
{
  use UlidIdTrait;


    /**
     * @ORM\Entity(repositoryClass=RecordRepository::class)
     */

    #[ORM\ManyToMany(targetEntity: IdentifierStructure::class, inversedBy: "recordLinks")]
    private $indentifierStructure;

    /**
     * @ORM\ManyToMany(targetEntity=NoteRecord::class, inversedBy="records")
     */

    #[ORM\ManyToMany(targetEntity: NoteRecord::class, inversedBy: "records")]
    private $noteRecords;

    /**
     * @ORM\OneToMany(targetEntity=SourceCitation::class, mappedBy="record")
     */

    #[ORM\OneToMany(targetEntity: SourceCitation::class, mappedBy: "record")]
    private $sourceCitations;

    /**
     * @ORM\OneToMany(targetEntity=MediaLink::class, mappedBy="record")
     */

    #[ORM\OneToMany(targetEntity: MediaLink::class, mappedBy: "record")]
    private $mediaLinks;

    public function __construct()
    {
        $this->indentifierStructure = new ArrayCollection();
        $this->noteRecords = new ArrayCollection();
        $this->sourceCitations = new ArrayCollection();
        $this->mediaLinks = new ArrayCollection();
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

    /**
     * @return Collection|SourceCitation[]
     */
    public function getSourceCitations(): Collection
    {
        return $this->sourceCitations;
    }

    public function addSourceCitation(SourceCitation $sourceCitation): self
    {
        if (!$this->sourceCitations->contains($sourceCitation)) {
            $this->sourceCitations[] = $sourceCitation;
            $sourceCitation->setRecord($this);
        }

        return $this;
    }

    public function removeSourceCitation(SourceCitation $sourceCitation): self
    {
        if ($this->sourceCitations->removeElement($sourceCitation)) {
            // set the owning side to null (unless already changed)
            if ($sourceCitation->getRecord() === $this) {
                $sourceCitation->setRecord(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediaLink[]
     */
    public function getMediaLinks(): Collection
    {
        return $this->mediaLinks;
    }

    public function addMediaLink(MediaLink $mediaLink): self
    {
        if (!$this->mediaLinks->contains($mediaLink)) {
            $this->mediaLinks[] = $mediaLink;
            $mediaLink->setRecord($this);
        }

        return $this;
    }

    public function removeMediaLink(MediaLink $mediaLink): self
    {
        if ($this->mediaLinks->removeElement($mediaLink)) {
            // set the owning side to null (unless already changed)
            if ($mediaLink->getRecord() === $this) {
                $mediaLink->setRecord(null);
            }
        }

        return $this;
    }
}
