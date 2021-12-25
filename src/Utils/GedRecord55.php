<?php

 /*
  * This file is part of the Asmild package.
  *
  * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
  *
  * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
  * @copyright 2020-2021 Filicis Software
  * @license MIT

  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

 namespace App\Utils;

 use Symfony\Component\String\UnicodeString;
 use function Symfony\Component\String\u;

 use App\Utils\GedcomException;
 use App\Utils\AbstractGedRecord;

 /**
  *  class AbstractGedRecord
  *
  * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
  * @copyright 2020-2021 Filicis Software
  * @license MIT
  *
  */

 class GedRecord55 extends AbstractGedRecord
 {

  protected function getMatch() : String
  {
    return self::MATCH55;
  }

 }


