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

use App\Repository\AddressStructureRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;

/**
*  class AddressStructure
*  - Implementerer Gercom V7 ADDRESS_STRUCTURE
*/

#[ ORM\Entity( repositoryClass: AddressStructureRepository::class ) ]

class AddressStructure {

    #[ ORM\Id ]
    #[ ORM\GeneratedValue ]
    #[ ORM\Column ]
    private ?int $id = null;

    /**
    *
    **/

    #[ ORM\Column( type: 'text', nullable: true ) ]
    private $addr;

    /**
    *
    **/

    #[ ORM\Column( type:'string', length: 60, nullable: true ) ]
    private $adr1;

    /**
    *
    **/

    #[ ORM\Column( type: 'string', length: 60, nullable: true ) ]
    private $adr2;

    /**
    *
    **/

    #[ ORM\Column( type: 'string', length: 60, nullable: true ) ]
    private $adr3;

    /**
    *
    **/

    #[ ORM\Column( type: 'string', length: 60, nullable: true ) ]
    private $city;

    /**
    * @ORM\Column( type = 'string', length = 60, nullable = true )
    **/

    #[ ORM\Column( type: 'string', length: 60, nullable: true ) ]
    private $stae;

    /**
    * @ORM\Column( type = 'string', length = 20, nullable = true )
    **/

    #[ ORM\Column( type: 'string', length: 20, nullable: true ) ]
    private $post;

    /**
    * @ORM\Column( type = 'string', length = 60, nullable = true )
    **/

    #[ ORM\Column( type: 'string', length: 60, nullable: true ) ]
    private $ctry;

    /**
    * @ORM\Column( type = 'array', nullable = true )
    **/

    #[ ORM\Column( type: Types::SIMPLE_ARRAY, nullable: true ) ]
    private $phon = [];

    /**
    * @ORM\Column( type = Types::ARRAY, nullable = true )
    **/

    #[ Assert\Email ]
    #[ ORM\Column( type: Types::SIMPLE_ARRAY, nullable: true ) ]
    private $email = [];

    /**
    * @ORM\Column( type = 'array', nullable = true )
    **/

    #[ ORM\Column( type: Types::SIMPLE_ARRAY, nullable: true ) ]
    private $fax = [];

    /**
    * @ORM\Column( type = 'array', nullable = true )
    **/

    #[ Assert\Url ]
    #[ ORM\Column( type: Types::SIMPLE_ARRAY, nullable: true ) ]
    private $www = [];

    /**
    *  function __construct()
    *
    **/

    public function __construct() {
        $this->phon = array();
        $this->email = array();
        $this->fax = array();
        $this->www = array();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getAddr(): ?string {
        return $this->addr;
    }

    public function setAddr( ?string $addr ): self {
        $this->addr = $addr;

        return $this;
    }

    public function getAdr1(): ?string {
        return $this->adr1;
    }

    public function setAdr1( ?string $adr1 ): self {
        $this->adr1 = $adr1;

        return $this;
    }

    public function getAdr2(): ?string {
        return $this->adr2;
    }

    public function setAdr2( ?string $adr2 ): self {
        $this->adr2 = $adr2;

        return $this;
    }

    public function getAdr3(): ?string {
        return $this->adr3;
    }

    public function setAdr3( ?string $adr3 ): self {
        $this->adr3 = $adr3;

        return $this;
    }

    public function getCity(): ?string {
        return $this->city;
    }

    public function setCity( ?string $city ): self {
        $this->city = $city;

        return $this;
    }

    public function getStae(): ?string {
        return $this->stae;
    }

    public function setStae( ?string $stae ): self {
        $this->stae = $stae;

        return $this;
    }

    public function getPost(): ?string {
        return $this->post;
    }

    public function setPost( ?string $post ): self {
        $this->post = $post;

        return $this;
    }

    public function getCtry(): ?string {
        return $this->ctry;
    }

    public function setCtry( ?string $ctry ): self {
        $this->ctry = $ctry;

        return $this;
    }

    public function getPhon(): ?array {
        return $this->phon;
    }

    public function setPhon( ?array $phon ): self {
        $this->phon = $phon;

        return $this;
    }

    public function getEmail(): ?array {
        return $this->email;
    }

    public function setEmail( ?array $email ): self {
        $this->email = $email;

        return $this;
    }

    public function getFax(): ?array {
        return $this->fax;
    }

    public function setFax( ?array $fax ): self {
        $this->fax = $fax;

        return $this;
    }

    public function getWww(): ?array {
        return $this->www;
    }

    public function setWww( ?array $www ): self {
        $this->www = $www;

        return $this;
    }

}
