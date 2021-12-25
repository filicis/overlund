<?php

/*
 * This file is part of the Asmild package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils;

use       App\Utils\GedInFile;
use       App\Utils\GedcomException;

use       Symfony\Component\HttpKernel\Log\Logger;

use				App\Utils\GedParser55;
use				App\Utils\GedParser551;
use				App\Utils\GedParser555;

/**
 *  class GedValidator
 *
 *  - Åbner en GedInFile ud fra en given path
 *  - Vælger en passende GedParser
 *
 * */


class GedValidator
{
  private $gfile;
  private $parser;

  /**
   *  function import
   *
   **/

  public function import(String $path)
  {
    $path= 'Aner.ged';


    $this->gfile= new GedInFile();
    $this->gfile->open($path);
    switch ($this->gfile->getGedcomVersion())
    {
    	case '5.5':
    	 $this->parser= new GedParser55();
    	 break;
    	 
      case '5.5.1':
    	 $this->parser= new GedParser551();
    	 break;

      case '5.5.5':
    	 $this->parser= new GedParser555();
    	 break;
    	
    }
    $this->parser->open($this->gfile);
    $this->parser->parse($this->gfile);
  }

}
