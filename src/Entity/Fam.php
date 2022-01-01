<?php

namespace App\Entity;

use       App\Repository\FamRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\Gedcom\Structure;

#[ORM\Entity(repositoryClass: FamRepository::class)]
class Fam extends GedcomStructure
{
}
