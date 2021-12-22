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

use       App\Entity\RecordSuperclass;
use       App\Entity\Traits\PersonalNamePieces;

use       App\Repository\PersonalNameStructureRepository;
use       Doctrine\ORM\Mapping as ORM;

  /**
   * @ORM\Entity(repositoryClass=PersonalNameStructureRepository::class)
   **/
   
class PersonalNameStructure extends RecordSuperclass
{
  use PersonalNamePieces;
  

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $personalName;

    /**
     * @ORM\ManyToOne(targetEntity=Individual::class, inversedBy="personalNameStructures")
     */
    private $individual;




    public function getPersonalName(): ?string
    {
        return $this->personalName;
    }

    public function setPersonalName(?string $personalName): self
    {
        $this->personalName = $personalName;

        return $this;
    }

    public function getIndividual(): ?Individual
    {
        return $this->individual;
    }

    public function setIndividual(?Individual $individual): self
    {
        $this->individual = $individual;

        return $this;
    }

}
