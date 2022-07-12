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


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\IndividualRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\RecordSuperclass;


  /**
   *
   **/

#[ORM\Entity(repositoryClass:  IndividualRepository::class)]
//# [ ORM\HasLifecycleCallbacks]
class Individual extends RecordSuperclass
{
    protected const XREF_PREFIX = 'I';


    /**
     *
     *  @var project Pointer til ejer projektet
     */

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "individuals")]
    private $project;

    /**
     *
     */

    #[ORM\OneToMany(targetEntity: PersonalNameStructure::class, mappedBy: "individual")]
    private $personalNameStructures;

    /**
     *
     */

    #[ORM\Column(type: 'string', length: 1, nullable: true)]
    private $sex;

    public function __construct()
    {
        $this->personalNameStructures = new ArrayCollection();
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
     * @return Collection|PersonalNameStructure[]
     */
    public function getPersonalNameStructures(): Collection
    {
        return $this->personalNameStructures;
    }

    public function addPersonalNameStructure(PersonalNameStructure $personalNameStructure): self
    {
        if (!$this->personalNameStructures->contains($personalNameStructure)) {
            $this->personalNameStructures[] = $personalNameStructure;
            $personalNameStructure->setIndividual($this);
        }

        return $this;
    }

    public function removePersonalNameStructure(PersonalNameStructure $personalNameStructure): self
    {
        if ($this->personalNameStructures->removeElement($personalNameStructure)) {
            // set the owning side to null (unless already changed)
            if ($personalNameStructure->getIndividual() === $this) {
                $personalNameStructure->setIndividual(null);
            }
        }

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }


}
