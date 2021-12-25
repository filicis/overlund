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
use				App\Utils\GedOrm;

use       App\GedInterface\GedHeader;
use 			App\GedInterface\GedTree;

/**
 *  class GedWriter
 *
 *  - Bør understøtte Gedcom versioner 5.5, 5.5.1, 5.5.5 samt 7.0
 *
 * */


class GedWriter
{
  private $gfile;
  private $parser;

  /**
   *  function export
   *
   *  - Åbner en output fil som angivet i Headeren
   *  - Vælger en specifik writer ud fra versionsangivelse i Headeren
   *  - Udskriver Headeren
   *  - Udskriver samtlige toplevel records i rækkefølge
   *  - Afslutter med terminatoren  
   *
   **/

  public function export(GedHeader $gedHeader, GedTree $gedTree)
  {
  }
}
