<?php

/**
 * This file is part of the Asmild package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2020-2021 Filicis Software
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/

namespace App\Utils;

use       Symfony\Component\String\UnicodeString;
use       function Symfony\Component\String\u;

use       App\Utils\GedcomException;

  /**
   *  class AbstractGedRecord
   *
  * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
  * @copyright 2020-2021 Filicis Software
  * @license MIT

   *
   **/

abstract class AbstractGedRecord
{
  /**
   *  record
   *
   *  Et array der omfatter følgende værdier:
   *
   *  0:  Den oprindelige gedcom linie
   *  1:  Level
   *  2:  xref
   *  3:  tag
   *  4:  pointer
   *  5:  value
   *
   **/

  const LINE      = 0;
  const LEVEL     = 1;
  const XREF      = 2;
  const TAG       = 3;
  const POINTER   = 4;
  const ESCAPE    = 5;
  const VALUE     = 6;

  private $record;

  protected int $position= -1;
  protected UnicodeString $line;

  protected int $level;
  protected UnicodeString $xref;
  protected UnicodeString $tag;
  protected UnicodeString $pointer;
  protected UnicodeString $escape;
  protected UnicodeString $value;

  const MLEVEL=       '/^(\d|[1-9]\d)';

    // The maximum length of the identifying part within the at signs is 20 code units

  const MXREF=        '(?:\x20@([0-9a-zA-z]{1,20})@)?';

    // The length of a GEDCOM tag is a maximum of 31 code units.

  const MTAG=         '\x20(\w{1,31})';
  const MESCAPE=      '(?:\x20@#([a-zA-Z][a-zA-Z\x20]{1,20})@)?';
  const MVALUE=       '(?:\x20(.*))?/';



  const MATCH55=    self::MLEVEL . self::MXREF . self::MTAG . self::MXREF . self::MESCAPE . self::MVALUE;
  const MATCH555=   self::MLEVEL . self::MXREF . self::MTAG . self::MXREF . self::MESCAPE . self::MVALUE;


  abstract protected function getMatch() : String;


  /**
   *  decode()
   *
   * */

  public function decode(int $position, UnicodeString $line)
  {
    $this->position= $position;

    $this->record= $line->match($this->getMatch());

    if (! $this->record)
    {
    	throw new GedcomException("Invalid line: " . $position . " : " . $position);

      // Invalid Gedcom Line
    }


  }


  /**
   *  encode()
   *
   **/

  public function encode($level)
  {
  }


  public function getEscape() : UnicodeString
  {
    return u($this->result(self::ESCAPE));
    // return $this->escape;
  }



  /**
   *  getPointer()
   *
   * */

  public function getPointer() : UnicodeString
  {
    return u($this->result(self::POINTER));
  }


  /**
   *  getPosition()
   *
   * */

  public function getPosition() : int
  {
    return $this->position;
  }


  /**
   *  getLevel()
   *
   * */

  public function getLevel() : int
  {
    return $this->result(self::LEVEL);
  }


  public function getTag() : UnicodeString
  {
    return u($this->result(self::TAG));
  }


  /**
   *  getValue()
   *
   * */

  public function getValue() : UnicodeString
  {
    return u($this->result(self::VALUE))->replace('@@', '@');
  }


  /**
   *  getXref()
   *
   * */

  public function getXref() : UnicodeString
  {
    return u($this->result(self::XREF));

    // return $this->xref;
  }


  private function result($key)
  {
    return ($this->record) ? $this->record[$key] : "";
  }


}

