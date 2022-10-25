<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/

// src/Twig/AppExtension.php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use Ds\Set;

class SetExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('newSet', [$this, '_newSet']),
        ];
    }

    public function _newSet(): Set
    {
        return new Set();
    }
}


