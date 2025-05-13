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

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\UnicodeString;
use function Symfony\Component\String\u;
use function Symfony\Component\String\b;
use Symfony\Component\Config\Definition\Exception\Exception;
use Psr\Log\LoggerInterface;


use App\Utils\GedFile;
use App\Utils\GedcomException;


  /**
   * class GedInFie
   *
   * - Opbygget omkring 'Basic GEDCOM Language'
   * - Implementerer \Iterator så vi kan vandre gennem Gedcom filen.
   *
   **/

class GedInFile extends GedFile  implements \Iterator
{

  private $flag= false;
  private $curr= null;
  private $gedcomVersion= "";

  /**
   *  detectFileEncoding
   *
   *  - Kaldes fra open umiddelbart efter åbning af input File
   *  - Checker for BOM og Line Terminator
   *
   *  - Udnytter at en valid Gedcom fil starter med linien '0 HEAD'
   *
   **/

  private function detectFileEncoding() : void
  {
    $this->fileencoding= self::ASCII;

      // Her udnytter vi at en Gedcom fil begynder med linien '0 HEAD'
      // - Første linie kan dermed højst være 16 bytes lang inklusive line terminator

    $buffer= fread($this->handle, 25);
    if ($buffer == false)
      throw new GedcomException("Unexpected EOF");
    rewind($this->handle);

    $p= b($buffer)->match(self::BOM_MATCH);

    if ($p)
    {
      $q;
      switch($this->bom= $p[1])
        {
          case self::BOM_UTF16BE:
            $this->fileencoding= self::UTF16BE;
            $q= b($buffer)->match(self::MATCHEOL16BE);
            break;
          case self::BOM_UTF16LE:
            $this->fileencoding= self::UTF16LE;
            $q= b($buffer)->match(self::MATCHEOL16LE);
            break;
          case self::BOM_UTF8:
            $this->fileencoding= self::UTF8;
          default:
             $q= b($buffer)->match(self::MATCHEOL);
        }
        if ($q)
          $this->eol= $q[1];
        else
          throw new GedcomException("Unknown EOL");
    }
    else
      throw new GedcomException("Unknown error");

  }


  /**
   *  function detectGedcomVersion()
   *
   *  - Her checker vi i første omgang kun HEAD.GEDC.VERS
   *
   **/

/* */
  private function detectGedcomVersion()
  {
    $this->rewind();
    if ($this->curr->getLevel() == 0)
    {
      switch($this->curr->getTag())
      {
        case 'HEADER':
        case 'HEAD':
          $this->next();
          while($this->curr->getLevel() == 1)
          {
            switch ($this->curr->getTag())
            {
              case 'GEDC':
                $this->next();
                while($this->curr->getLevel() == 2)
                {
                  switch($this->curr->getTag())
                  {
                    case 'VERS':
                      switch($this->gedcomVersion= $this->curr->getValue())
                      {
                        case '5.5':
                        case '5.5.1':
                        case '5.5.5':
                          return;

                        default:
                          throw new GedcomException("Unsupported Gedcom Version: " . $this->gedcomVersion);

                      }

                    default:
                      $this->skip();
                  }
                }


              default:
                $this->skip();
            }

          }
          break;

        default:
          break;
      }

    }
    throw new GedcomException("Probably not a GEDCOM file");
  }

/* */

  /**
   * function skip()
   *
   **/

  private function skip()
  {
    $level= $this->curr->getLevel();
    do
    {
      $this->next();
    }
    while($level < $this->curr->getLevel());
  }


	/**
	 *	function getGetcomVersion()
	 *
	 **/
	 /*
	 public function getGedVersion()
	 {
	 	 return "";
	 }
   */

	 public function getGedcomVersion() : string
	 {
	 	 return $this->gedcomVersion;
	 }


  /**
   *  open()
   *
   **/

  public function open(String $path)
  {
    $this->counter= 0;

    if ($this->handle= fopen($path, "rb"))
    {

      $this->detectFileEncoding();
      $this->detectGedcomVersion();
      $this->rewind();
    }
    else
      throw new GedcomException("Unable to open file");
  }




  /**
   *  function readLine()
   *
   *
   * */


  protected function readLine() : UnicodeString
  {
    if (($line= stream_get_line($this->handle, 1024, $this->eol)) !== false)
    {
      switch($this->fileencoding)
      {
        case self::UTF16LE:
                $g= mb_convert_encoding($line, 'UTF-8', 'UTF-16LE');
                break;

        case self::UTF16BE:
                $g= mb_convert_encoding($line, 'UTF-8', 'UTF-16BE');
          break;
        default:
          $g= $line;
      }
    }
    else
    {
      $g= "";
      $this->flag= false;
    }
    return u($g);
  }


  /**
   *  function current
   *
   * */

 public function current() : mixed
  {
    return $this->curr;
  }


  /**
   *  function key();
   *
   * */

  public function key()
  {
    return "";
  }


  /**
   *  function next()
   *
   **/

  public function next(): void
  {
    $this->flag= true;
    $this->curr= new GedRecord55();
    $this->curr->decode(++$this->counter, $this->readLine());
  }


  /**
   *  function rewind();
   *
   * */

  public function rewind(): void
  {
    if (fseek($this->handle, strlen($this->bom)) == 0)
    {
      $this->flag= true;
      $this->counter= -1;
      $this->next();
    }
    else
      $this->flag= false;
  }


  public function valid(): bool
  {
    return $this->flag;
  }


  public function eof()
  {
    $this->flag= false;
  }


}
