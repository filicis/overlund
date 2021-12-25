<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 80)]
    private $parameter1;

    #[ORM\Column(type: 'integer')]
    private $parameter2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParameter1(): ?string
    {
        return $this->parameter1;
    }

    public function setParameter1(string $parameter1): self
    {
        $this->parameter1 = $parameter1;

        return $this;
    }

    public function getParameter2(): ?int
    {
        return $this->parameter2;
    }

    public function setParameter2(int $parameter2): self
    {
        $this->parameter2 = $parameter2;

        return $this;
    }
}
