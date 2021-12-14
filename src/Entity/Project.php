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

  /**
   *  Project
   *  -
   *
   *
   * @ORM\Entity(repositoryClass=ProjectRepository::class)
   **/


class Project
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $title;

    /**
     * @ORM\Column(type="string", unique=true, length=30)
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity=Family::class, mappedBy="project")
     */
    private $families;

    /**
     * @ORM\OneToMany(targetEntity=Individual::class, mappedBy="project")
     */
    private $individuals;

    /**
     * @ORM\OneToMany(targetEntity=SubmitterRecord::class, mappedBy="project")
     */
    private $submitterRecords;

    public function __construct()
    {
        $this->families = new ArrayCollection();
        $this->individuals = new ArrayCollection();
        $this->submitterRecords = new ArrayCollection();
    }

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
}
