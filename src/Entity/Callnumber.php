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

use       App\Repository\CallnumberRepository;
use       Doctrine\ORM\Mapping as ORM;


/**
 *  class Callnumber
 *
 *  Implementerer Gedcom v7 CALN substrukturen
 **/


#[ORM\Entity(repositoryClass: CallnumberRepository::class)]
class Callnumber
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;


  /**
   *
   **/

  #[ORM\Column(length: 255)]
  private ?string $callnumber = null;


  /**
   *
   **/

  #[ORM\Column(length: 255)]
  private ?string $medium = null;

  #[ORM\ManyToOne(inversedBy: 'callnumbers')]
  #[ORM\JoinColumn(nullable: false)]
  private ?SourceRepositoryCitation $sourceRepositoryCitation = null;


  /**
   *
   **/

  public function getId(): ?int
  {
    return $this->id;
  }


  /**
   *
   **/

  public function getCallnumber(): ?string
  {
    return $this->callnumber;
  }


  /**
   *
   **/

  public function setCallnumber(string $callnumber): self
  {
    $this->callnumber = $callnumber;

    return $this;
  }


  /**
   *
   **/

  public function getMedium(): ?string
  {
    return $this->medium;
  }


  /**
   *
   **/

  public function setMedium(string $medium): self
  {
    $this->medium = $medium;

    return $this;
  }

  /**
   * 
   * 
   */

  public function getSourceRepositoryCitation(): ?SourceRepositoryCitation
  {
      return $this->sourceRepositoryCitation;
  }


  /**
   * 
   * 
   */

  public function setSourceRepositoryCitation(?SourceRepositoryCitation $sourceRepositoryCitation): self
  {
      $this->sourceRepositoryCitation = $sourceRepositoryCitation;

      return $this;
  }
}
