<?php

/*
 * This file is part of the Asmild package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/

namespace App\Utils;

use       App\Utils\GedInFile;
use       App\Utils\GedcomException;

use       Symfony\Component\HttpKernel\Log\Logger;

use				App\Utils\GedParser55;
use				App\Utils\GedParser551;
use				App\Utils\GedParser555;
use				App\Utils\GedOrm;

use 			App\GedInterface\GedTree;

// use       App\Utils\GedcomException;


/**
 *  class GedReader
 *
 *  Importerer en gives GED fil ind i databasen
 *
 *  - Åbner en GedInFile ud fra en given path
 *  - Vælger en passende GedParser
 *  - Bør understøtte Gedcom versioner 5.5, 5.5.1, 5.5.5 samt 7.0
 *
 **/


class GedReader
{
  private $gfile;
  private $parser;

  /**
   *  function import
   *
   **/

  public function import(String $path, GedTree $gedTree)
  {
    $path= '/home/michael/php/tcgb/public/Aner.ged';
    // $path= '/home/michael/php/tcgb/public/555SAMPLE.GED';


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

    $gedTree->prepare();
    $this->parser->open($this->gfile, $gedTree);
    $this->parser->parse();

			// throw new GedcomException("*** FINISH ***");

    $gedTree->finish();
			//  throw new GedcomException("*** FINISH ***");
    return;
  }
}
