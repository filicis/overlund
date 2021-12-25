<?php

 /**
  * This file is part of the Asmild package.
  *
  * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
  *
  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

 namespace App\Utils;

 use Symfony\Component\String\UnicodeString;
 use function Symfony\Component\String\u;

 use App\Utils\GedcomException;
 use App\UtilsAbstractGedRecord;

 /**
  *  class GedRecord555
  *
  *
  */

 class GedRecord555 extends AbstractGecRecord
 {

  protected function getMatch() : String
  {
    return self::MATCH555;
  }

 }


