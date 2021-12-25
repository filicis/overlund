<?php

/**
 * This file is part of the Overlund package.
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2020-2021 Filicis Software
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/

namespace App\Utils;

// use Psr\Log\LoggerInterface;

/**
 *  class GedFile
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2020-2021 Filicis Software
 * @license MIT
 **/

class GedFile
{

  const ASCII           = "ASCII";
  const UTF8            = "UTF8";
  const UTF16LE         = "UTF16LE";
  const UTF16BE         = "UTF16BE";

  const CR              = "\r";
  const LF              = "\n";
  const CRLF            = "\r\n";

  const UTF16LE_CR      = "\r\x00";
  const UTF16LE_LF      = "\n\x00";
  const UTF16LE_CRLF    = "\r\x00\n\x00";

  const UTF16BE_CR      = "\x00\r";
  const UTF16BE_LF      = "\x00\n";
  const UTF16BE_CRLF    = "\x00\r\x00\n";

  const MATCHEOL        = '/(\r\n|\r|\n)/';
  const MATCHEOL16LE    = '/(\r\x00\n\x00|\r\x00|\n\x00)/';
  const MATCHEOL16BE    = '/(\x00\r\x00\n|\x00\r|\x00\n)/';





  const BOM_NONE        = "";
  const BOM_UTF8        = "\xef\xbb\xbf";
  const BOM_UTF16LE     = "\xff\xfe";
  const BOM_UTF16BE     = "\xfe\xff";

  const BOM_MATCH       = "/^(\xef\xbb\xbf|\xff\xfe|\xfe\xff|)/";

  protected $handle;
  protected $bom= self::BOM_NONE;
  protected $encoding;
  protected $fileencoding; //
  protected $eol;
//  protected $logger;


  public $counter= -1;

  /**
   * _construct
   *
   * Sikrer at vi kan anvende loggerinterface i alle afledte objekter
   *
   * */
/*
  function __construct(LoggerInterface $logger)
  {
    $this->logger= $logger;
      //mb_internal_encoding("UTF-8");
  }

*/

}


