<?php

/**                                                                                                                                       
 * This file is part of the Overlund package.                                                                                             
 *                                                                                                                                     
 * author Michael Lindhardt Rasmussen <filicis@gmail.com>                                                                                
 * @copyright 2000-2022 Filicis Software                                                                                                  
 * @license MIT                                                                                                                           
 *                                                                                                                                        
 * For the full copyright and license information, please view the LICENSE                                                                
 * file that was distributed with this source code.                                                                                       
 */                                                                                                                                       
    

namespace App\Entity;

use App\Repository\CitationStructureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitationStructureRepository::class)]
class CitationStructure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?SourceRecord $sourceRecord = null;

    #[ORM\Column(length: 255)]
    private ?string $page = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $event = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $quality = null;

    #[ORM\ManyToOne(inversedBy: 'citationStructures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CitationLink $citationLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSourceRecord(): ?SourceRecord
    {
        return $this->sourceRecord;
    }

    public function setSourceRecord(SourceRecord $sourceRecord): self
    {
        $this->sourceRecord = $sourceRecord;

        return $this;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function setPage(string $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(?string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(string $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getCitationLink(): ?CitationLink
    {
        return $this->citationLink;
    }

    public function setCitationLink(?CitationLink $citationLink): self
    {
        $this->citationLink = $citationLink;

        return $this;
    }
}
