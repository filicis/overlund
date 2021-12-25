<?php

  //  Class GedOutFile
  //
  //  - Åbner en fil til skrivning
  //  - Typisk i UTF-8 formant med BOM
  //  - Skriver filen linjevis via GedRecords
  //
  //  - Kræver kun begrænset funktionalitet

namespace App\Utils;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\UnicodeString;
use function Symfony\Component\String\u;
use function Symfony\Component\String\b;
use Symfony\Component\Config\Definition\Exception\Exception;
use Psr\Log\LoggerInterface;


use App\Utils\GedcomException;
// use App\Service\GedcomLine;


class GedOutFile
{

}
