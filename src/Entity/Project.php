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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

use       App\Entity\Traits\UlidIdTrait;
use       App\Entity\GedcomStructure;

  /**
   *  Project
   *  -
   *
   *
   * @ORM\Entity(repositoryClass=ProjectRepository::class)
   **/

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
  use UlidIdTrait;


    /**
     * @ORM\Column(type="string", length=80)
     */

    #[ORM\Column(type: "string", length: 80)]
    private $title;

    /**
     * @ORM\Column(type="string", unique=true, length=30)
     */

    #[ORM\Column(type: "string", unique: true, length: 30)]
    private $url;

    /**
     * @ORM\OneToMany(targetEntity=Family::class, mappedBy="project")
     */

    #[ORM\OneToMany(targetEntity: Family::class, mappedBy: "project")]
    private $families;

    /**
     * @ORM\OneToMany(targetEntity=Individual::class, mappedBy="project")
     */

    #[ORM\OneToMany(targetEntity: Individual::class, mappedBy: "project")]
    private $individuals;

    /**
     * @ORM\OneToMany(targetEntity=SubmitterRecord::class, mappedBy="project")
     */

    #[ORM\OneToMany(targetEntity: SubmitterRecord::class, mappedBy: "project")]
    private $submitterRecords;

    /**
     * @ORM\OneToMany(targetEntity=MediaRecord::class, mappedBy="project")
     */

    #[ORM\OneToMany(targetEntity: MediaRecord::class, mappedBy: "project")]
    private $mediaRecords;

    /**
     * @ORM\OneToMany(targetEntity=PlaceRecord::class, mappedBy="project")
     */

    #[ORM\OneToMany(targetEntity: PlaceRecord::class, mappedBy: "project")]
    private $placeRecords;

    /**
     * @ORM\OneToMany(targetEntity=GedcomStructure::class, mappedBy="project", orphanRemoval=true)
     */

    #[ORM\OneToMany(targetEntity: GedcomStructure::class, mappedBy: "project", orphanRemoval: true)]
    private $gedcomStructures;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $GedcomFilename;

    public function __construct()
    {
        $this->families = new ArrayCollection();
        $this->individuals = new ArrayCollection();
        $this->submitterRecords = new ArrayCollection();
        $this->mediaRecords = new ArrayCollection();
        $this->placeRecords = new ArrayCollection();
        $this->gedcomStructures = new ArrayCollection();
    }


    /**
     *
     **/

    public function __toString()
    {
      return $this->url . ' - ' . $this->title;        
    }        

    /**
     *
     **/

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Family[]
     */
    public function getFamilies(): Collection
    {
        return $this->families;
    }

    public function addFamily(Family $family): self
    {
        if (!$this->families->contains($family)) {
            $this->families[] = $family;
            $family->setProject($this);
        }

        return $this;
    }

    public function removeFamily(Family $family): self
    {
        if ($this->families->removeElement($family)) {
            // set the owning side to null (unless already changed)
            if ($family->getProject() === $this) {
                $family->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Individual[]
     */
    public function getIndividuals(): Collection
    {
        return $this->individuals;
    }

    public function addIndividual(Individual $individual): self
    {
        if (!$this->individuals->contains($individual)) {
            $this->individuals[] = $individual;
            $individual->setProject($this);
        }

        return $this;
    }

    public function removeIndividual(Individual $individual): self
    {
        if ($this->individuals->removeElement($individual)) {
            // set the owning side to null (unless already changed)
            if ($individual->getProject() === $this) {
                $individual->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SubmitterRecord[]
     */
    public function getSubmitterRecords(): Collection
    {
        return $this->submitterRecords;
    }

    public function addSubmitterRecord(SubmitterRecord $submitterRecord): self
    {
        if (!$this->submitterRecords->contains($submitterRecord)) {
            $this->submitterRecords[] = $submitterRecord;
            $submitterRecord->setProject($this);
        }

        return $this;
    }

    public function removeSubmitterRecord(SubmitterRecord $submitterRecord): self
    {
        if ($this->submitterRecords->removeElement($submitterRecord)) {
            // set the owning side to null (unless already changed)
            if ($submitterRecord->getProject() === $this) {
                $submitterRecord->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediaRecord[]
     */
    public function getMediaRecords(): Collection
    {
        return $this->mediaRecords;
    }

    public function addMediaRecord(MediaRecord $mediaRecord): self
    {
        if (!$this->mediaRecords->contains($mediaRecord)) {
            $this->mediaRecords[] = $mediaRecord;
            $mediaRecord->setProject($this);
        }

        return $this;
    }

    public function removeMediaRecord(MediaRecord $mediaRecord): self
    {
        if ($this->mediaRecords->removeElement($mediaRecord)) {
            // set the owning side to null (unless already changed)
            if ($mediaRecord->getProject() === $this) {
                $mediaRecord->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlaceRecord[]
     */
    public function getPlaceRecords(): Collection
    {
        return $this->placeRecords;
    }

    public function addPlaceRecord(PlaceRecord $placeRecord): self
    {
        if (!$this->placeRecords->contains($placeRecord)) {
            $this->placeRecords[] = $placeRecord;
            $placeRecord->setProject($this);
        }

        return $this;
    }

    public function removePlaceRecord(PlaceRecord $placeRecord): self
    {
        if ($this->placeRecords->removeElement($placeRecord)) {
            // set the owning side to null (unless already changed)
            if ($placeRecord->getProject() === $this) {
                $placeRecord->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GedcomStructure[]
     */
    public function getGedcomStructures(): Collection
    {
        return $this->gedcomStructures;
    }

    public function addGedcomStructure(GedcomStructure $gedcomStructure): self
    {
        if (!$this->gedcomStructures->contains($gedcomStructure)) {
            $this->gedcomStructures[] = $gedcomStructure;
            $gedcomStructure->setProject($this);
        }

        return $this;
    }

    public function removeGedcomStructure(GedcomStructure $gedcomStructure): self
    {
        if ($this->gedcomStructures->removeElement($gedcomStructure)) {
            // set the owning side to null (unless already changed)
            if ($gedcomStructure->getProject() === $this) {
                $gedcomStructure->setProject(null);
            }
        }

        return $this;
    }

    public function getGedcomFilename(): ?string
    {
        return $this->GedcomFilename;
    }

    public function setGedcomFilename(?string $GedcomFilename): self
    {
        $this->GedcomFilename = $GedcomFilename;

        return $this;
    }
}
