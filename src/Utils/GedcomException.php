<?php

namespace App\Utils;

use Symfony\Component\Config\Definition\Exception\Exception;

use App\Service\GedcomLine;

/**
* GedcomException
*
**/

class GedcomException extends Exception
{
  protected GedcomLine $gline;


  public function __construct($message = null, GedcomLine $gline = null, $code = 0, Throwable $previous = null)
  {
    parent::__construct('GEDCOM Syntax Errer: ' . $message, $code, $previous);

    if ($gline != null)

    $this->gline= $gline;
  }


  public function getGedcomLine() : GedcomLine
  {
    return $this->gline;
  }

}

