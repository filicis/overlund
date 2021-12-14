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
use App\Repository\IndividualRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Traits\XrefTrait;

  /**
   * @ORM\Entity(repositoryClass=IndividualRepository::class)
   **/

class Individual
{
  use XrefTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)

     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="individuals")
     */
    private $project;


    /**
     * @ORM\OneToMany(targetEntity=NameStructure::class, mappedBy="individual")
     */
    private $nameStructures;

    public function __construct()
    {
        $this->nameStructures = new ArrayCollection();
    }

    public function getId(): ?Ulid
    {
        return $this->id;
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


    /**
     * @return Collection|NameStructure[]
     */
    public function getNameStructures(): Collection
    {
        return $this->nameStructures;
    }

    public function addNameStructure(NameStructure $nameStructure): self
    {
        if (!$this->nameStructures->contains($nameStructure)) {
            $this->nameStructures[] = $nameStructure;
            $nameStructure->setIndividual($this);
        }

        return $this;
    }

    public function removeNameStructure(NameStructure $nameStructure): self
    {
        if ($this->nameStructures->removeElement($nameStructure)) {
            // set the owning side to null (unless already changed)
            if ($nameStructure->getIndividual() === $this) {
                $nameStructure->setIndividual(null);
            }
        }

        return $this;
    }
}
