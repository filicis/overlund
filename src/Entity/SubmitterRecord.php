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

use       App\Repository\SubmitterRecordRepository;
use       Doctrine\ORM\Mapping as ORM;

use       App\Entity\RecordSuperclass;
use       App\Entity\AddressStructure;

use       App\Entity\Traits\AddressTrait;
use       App\Entity\Traits\IdentifierTrait;

/**
*  class SubmitterRecord
**/

#[ ORM\Entity( repositoryClass: SubmitterRecordRepository::class ) ]
#[ ORM\Table( name: 'submitterrecord' ) ]

class SubmitterRecord extends RecordSuperclass {
    use IdentifierTrait;

    protected const XREF_PREFIX = 'S';

    #[ Embedded( class: AddressStructure::class ) ]
    private AddressStructure $address;

    /**
    */

    #[ ORM\ManyToOne( targetEntity: Project::class, inversedBy: 'submitterRecords' ) ]
    private $project;

    /** */

    public function __construct()  {
        parent::__construct();
        $this->address = new AddressStructure();
    }

    public function getProject(): ?Project {
        return $this->project;
    }

    public function setProject( ?Project $project ): self {
        $this->project = $project;

        return $this;
    }
}
