<?php

/**
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

// use				App\Utils\GedOrm;

use       App\GedInterface\GedStructure;

use				App\GedInterface\GedTree;
use				App\GedInterface\GedRecord;
use 			App\GedInterface\GedFamilyRecord;
use       App\GedInterface\GedHeaderRecord;
use 			App\GedInterface\GedIndividualRecord;
use 			App\GedInterface\GedNoteRecord;
use 			App\GedInterface\GedMediaRecord;
use 			App\GedInterface\GedPlaceRecord;
use 			App\GedInterface\GedRepositoryRecord;
use 			App\GedInterface\GedSourceRecord;
use 			App\GedInterface\GedSubmitterRecord;

use       App\GedInterface\Structure\GedAddressStructure;

use       App\GedInterface\Structure\GedChangeDateStructure;
use       App\Gedinterface\Structure\GedMediaStructure;
use       App\Gedinterface\Structure\GedSourceCitation;


// use       App\GedInterface\GedHeader;

use       Symfony\Component\HttpKernel\Log\Logger;

/**
 *  class AbstractGedParser
 *  - Indeholder grundlæggende funktionalitet der går igen i alle gedcom version
 *
 *
 * */


abstract class AbstractGedParser
{
  protected GedInFile $gfile;
  protected GedTree		$gedTree;


  /**
   *  function open()
   *
   **/

  public function open(GedInFile $gfile, GedTree $gedTree)
  {
    $this->gfile= $gfile;
    $this->gedTree= $gedTree;

  }


  /**
   *  function _parse()
   *
   *
   **/

  protected function _parse(String $callable, GedStructure $gedStructure, int $level= 0)
  {
    $lev= $this->gfile->current()->getLevel();
    do
    {
      $curr= $this->gfile->current();

      if ($curr->getLevel() == $lev)
      {
        call_user_func(array($this, $callable), $gedStructure, $level);
      }
      else
        return;

    }
    while($this->gfile->valid());
  }


  /**
   *  function parseToplevel()
   *
   *
   **/

  private function parseToplevel(String $callable)
  {
    echo "Parse Toplevel Start\r\n";
    do
    {
      if ($this->gfile->current()->getLevel() != 0)
        throw new GedcomException("Toplevel Error");
    }
    while(! call_user_func(array($this, $callable), $this->gedTree));
    echo "Parse Toplevel Slut\r\n";
  }


  /**
   *  function _parseXX()
   *
   *
   **/

  protected function _parseXX(String $callable, GedStructure $gedStructure)
  {
    $level= $this->gfile->current()->getLevel();

    $this->gfile->next();
    do
    {
      $curr= $this->gfile->current();

      if ($level < $curr->getLevel())
      {
        call_user_func(array($this, $callable), $gedStructure);
      }
      else
        return;

    }
    while($this->gfile->valid());
  }





  /**
   *  function parse01()
   *  - Grundlæggende funktionalitet der dækker alle gedcom versioner
   *  - Eneste anmærkning er SUBN tagget der er obsolet, det ignoreres...
   *
   *  TODO: Undersøttelse af extension tags
   *  - Da vi ikke kender betydningen af disse tags, skal de gemmes i nogen form af Note
   * */

protected function parse01(GedTree $gedTree) : bool
{
  //echo "Parse 01 start\r\n";
  $xref= $this->gfile->current()->getXref();
  switch($this->gfile->current()->getTag())
  {
    case 'FAM':
      $gedTree->newFamilyRecord($xref);
      break;

    case 'HEAD':
      break;

    case 'INDI':
      $gedTree->newIndividualRecord($xref);
      break;

    case 'NOTE':
      $gedTree->newNoteRecord($xref);
      break;

    case 'OBJE':
      $gedTree->newMediaRecord($xref);
      break;

    //	SUBN
    //	- Obsolete, Specific to Ancestral File.

    case 'SUBN':
      break;

    case 'SUBM':
      $gedTree->newSubmitterRecord($xref);
      break;

    case 'SOUR':
      $gedTree->newSourceRecord($xref);
      break;

    case 'REPO':
      $gedTree->newRepositoryRecord($xref);
      break;

    case 'TRLR':
      echo "Parse 01 End\r\n";
      return true;

    default:
      throw new GedcomException("Unexpected Tag: " . $this->gfile->getTag());
  }
  $this->skip();
  return false;
}



/**
*  function parse02Head()
*
**/

protected function parse02Head(GedTree $gedTree) : bool
{
  $curr= $this->gfile->current();
  switch($curr->getTag())
  {
    case 'HEAD':
      $this->_parseXX('parseHeaderRecord', $gedTree->getHeaderRecord(), 1);

      break;

    default:
      throw new GedcomException("Unexpected Tag i Header: " . $curr->getTag() . "  Pos: " . $curr.getPosition());
  }
  return true;
}





/**
*  function parse02()
*  - alle toplevel records er forud indlæst i rudimentær form (xref).
*
**/

protected function parse02(GedTree $gedTree) : bool
{

  $curr=$this->gfile->current();


  switch($curr->getTag())
  {
    case 'FAM':
      throw new GedcomException("STOP FAM");
      $record= $gedTree->findFamilyRecordByXref($curr->getXref());
      $this->familyRecord($record);
      break;

    case 'INDI':
      echo "INDI - xref: " . $curr->getXref() . "\r\n";
      $record= $gedTree->findIndividualRecordByXref($curr->getXref());
      if (! $record)
        throw new GedcomException('Record not found: Probably internal database error...');
      $this->_parseXX('parseIndividualRecord', $record);
      break;

    case 'NOTE':
      throw new GedcomException("STOP NOTE");
      //$record= $gedStructure->findNoteRecordByXref($curr->getXref());
      //$this->noteRecord($record);
      $this->skip();
      break;

    //
    //

    case 'OBJE':
      throw new GedcomException("STOP OBJE");
      // $this->multimediaRecord();
      // $record= $gedTree->findMediaRecordByXref($curr->getXref());
      //$this->mediaRecord($record);
      $this->skip();
      break;


    //	SUBN
    //	- Obsolete, Specific to Ancestral File.

    case 'SUBN':
      // throw new GedcomException("STOP SUBN");
      $this->skip();
      break;

    case 'SUBM':
      // throw new GedcomException("STOP");
      echo "SUBM\r\n";
      // $record= $gedStructure->findSubmitterRecordByXref($curr->getXref());
      // $this->submitterRecord($record);
      // $this->submitterRecord();
      $this->skip();
      break;

    case 'SOUR':
      throw new GedcomException("STOP SOUR");
      //echo "SOUR";
      //$record= $gedTree->findSourceRecordByXref($curr->getXref());
      //$this->SourceRecord($record);
      // $this->sourceRecord();
      $this->skip();
      break;

    case 'REPO':
      throw new GedcomException("STOP");
      //$record= $gedTree->findRepositoryRecordByXref($curr->getXref());
      //$this->RepositoryRecord($record);
      // $this->repositoryRecord();
      $this->skip();
      break;

    case 'TRLR':
      throw new GedcomException("STOP TRLR");

      return true;

    default:
      throw new GedcomException("Unexpected Tag: " . $curr->getTag());
  }
  return false;
}

  /**
   *  function parse()
   *
   *	Opdeles i 2
   *	- parse01: Summarisk behandling af toplevel records
   *  - parse02: Systemarisk indlæsning af alle data
   *
   **/

  public function parse()
  {
  	//    throw new GedcomException("*** STOP *** ");

  	//$this->_parse('parse01', $this->gedTree, 0);
  	$this->parseToplevel('parse01');



  	$this->gfile->rewind();

    echo "Head\r\n";
    // Første Toplevel Record er HEAD

  	// $this->_parse('parse02Head', $this->gedTree, 0);
  	$this->parseToplevel('parse02Head');


    // Her følger de øvrige Toplevel Records

  	// $this->_parse('parse02', $this->gedTree, 0);
  	$this->parseToplevel('parse02');




  }


//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************
//
//	Toplevel Records

  abstract public function familyRecord(GedFamilyRecord $record);

  // abstract protected function headerRecord(GedHeaderRecord $hdr);

  protected function parseHeaderRecord(GedHeaderRecord $gedHeaderRecord)
  {
  	//    throw new GedcomException("*** STOP parseHeaderRecord *** ");

  }


  protected function parseIndividualRecord(GedIndividualRecord $gedIndividualRecord)
  {
  	throw new GedcomException("*** STOP parseIndividualRecord *** ");

  }



  protected function parseSubmitterRecord(GedSubmitterRecord $gedSubmitterRecord)
  {
  	throw new GedcomException("*** STOP parseSubmitterRecord *** ");

  }





  public function individualRecord(GedIndividualRecord $record)
  {}

  /**
   *  function mediaRecord()
   *
   **/

  public function mediaRecord(GedMediaRecord $record)
  {
  	$this->skip();
  }


  abstract public function noteRecord(GedNoteRecord $record);


  /**
   *  function repositoryRecord()
   *
   **/

  public function repositoryRecord()
  {
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {
					case 'ADDR':
        	case 'NAME':
        	case 'NOTE':
					case 'PHON':
        	case 'PLAC':

        	case 'CONT':
        	  $this->skip();
        	  break;

          case 'CHAN':
            // $this->chan();
            $this->skip();
            break;

          case 'RIN':
            $this->gfile->next();
            break;


          case 'SOUR':
						// $this->sourceCitation()
            $this->skip();
            break;

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }

      }
      else
      {
        return;
      }
    }
  }




  /**
   *  function sourceRecord()
   *
   **/

  public function sourceRecord()
  {
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {
        	case 'OBJE':
        	  //$this->multimediaLink();
        	  $this->skip();
        	  break;

        	case 'ABBR':
        	case 'AUTH':
        	case 'RFN':
					case 'LANG':
					case 'ADDR':
        	case 'NAME':
        	case 'NOTE':
        	case 'PUBL':
        	case 'REPO':
        	case 'TEXT':
        	case 'TITL':
        	case 'DATA':
        	  $this->skip();
        	  break;

          case 'CHAN':
            //$this->chan();
            $this->skip();
            break;

          case 'RIN':
            $this->gfile->next();
            break;

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }

      }
      else
      {
        return;
      }
    }
  }







  /**
   *  function submitterRecord()
   *
   **/

  public function submitterRecord(GedSubmitterRecord $rec)
  {
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {
        	case 'RFN':
					case 'LANG':
					case 'ADDR':
        	case 'NAME':
        	case 'NOTE':
        	case 'PHON':
        	  $this->skip();
        	  break;

          case 'CHAN':
            $this->chanStructure();
            break;

          case 'RIN':
            $this->gfile->next();
            break;

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }

      }
      else
      {
        return;
      }
    }
  }





//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************
//
//	Underliggende strukturer i alfabetisk rækkefølge


	/**
	 *	protected function aliaStructure()
	 *
	 *	TODO: Implementeres
	 **/

	 protected function aliaStructure()
	 {
	 	 $this->skip();
	 }



	/**
	 *	protected function assoStructure()
	 *
	 *	TODO: Implementeres
	 **/

	 protected function assoStructure()
	 {
	 	 $this->skip();
	 }




	/**
	 *	function chanStructure()
	 *
	 *	TODO: Skal implementeres
	 **/

	protected function chanStructure( )
	{
		$level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'DATE':
        	  $this->skip();
        	  break;

          case 'NOTE':
            $this->skip();
            break;

          default;
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }
      }
      else
      {
       	return;
      }
    }


		//$this->skip();
	}

	/**
	 *	protected function famcStructure()
	 *
	 *	TODO: Implementeres
	 **/

	 protected function famcStructure()
	 {
	 	 $this->skip();
	 }


	/**
	 *	protected function famsStructure()
	 *
	 *	TODO: Implementeres
	 **/

	 protected function famsStructure()
	 {
	 	 $this->skip();
	 }


	 protected function parseFams()
	 {
     $curr= $this->gfile->current();
	 	 $this->skip();
	 }






	/**
	 *	protected function nameStructure()
	 *
	 *	TODO: Implementeres
	 **/

	 protected function nameStructure()
	 {
	 	 $this->skip();
	 }


	/**
	 *	protected function individualEventStructure()
	 *
	 *	TODO: Implementeres
	 **/

	 protected function individualEventStructure()
	 {
	 	 $this->skip();
	 }



	/**
	 *	protected function submStructure()
	 *
	 *	TODO: Implementeres
	 **/

	 protected function submStructure()
	 {
	 	 $this->skip();
	 }





  protected function SourceCitation(GedSourceCitation $cit)
  {

  }




  /**
   *	function gedx
   *
   **/

  protected function gedc()
  {
    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'VERS':
        	  $this->skip();
        	  break;

        	case 'FORM':
        	  $this->skip();
        	  break;

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getPosition());
        }
      }
      else
      {
       	return;
      }
    }
  }




  /**
   * function head_dest()
   *
   **/

  protected function head_dest()
  {
  }


//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************



	/**
	 *	function addressStructure
	 *	- Gedcom version
	 *
	 **/

public function parseAddr(GedAddressStructure $struc)
{
  //throw new GedcomException("** STOP ! **");

  $curr= $this->gfile->current();
  switch($curr->getTag())
  {
    case 'ADR1':
      $struc->setAdr1($curr->getValue());
      $this->skip();
      break;

    case 'ADR2':
      $struc->setAdr2($curr->getValue());
      $this->skip();
      break;

    case 'ADR3':
      $struc->setAdr3($curr->getValue());
      $this->skip();
      break;

    case 'CITY':
      $struc->setCITY($curr->getValue());
      $this->skip();
      break;

    case 'STAE':
      $struc->setStae($curr->getValue());
      $this->skip();
      break;

    case 'POST':
      $struc->setPost($curr->getValue());
      $this->skip();
      break;

    case 'CTRY':
      $struc->setCtry($curr->getValue());
      $this->skip();
      break;

    default:
      throw new GedcomException("Unexepect Tag: " . $curr->getPosition());
  }

}


	/**
	 *	function parseIndividualEvent
	 *	- Gedcom version
	 *
	 **/

public function parseIndividualEvent(GedIndividualEventStructure $struc)
{
  //throw new GedcomException("** STOP ! **");

  $curr= $this->gfile->current();
  switch($curr->getTag())
  {
    case 'AGE':
      $struc->setAge($curr->getValue());
      $this->skip();
      break;

    case 'ADR2':
      $struc->setAdr2($curr->getValue());
      $this->skip();
      break;

    case 'ADR3':
      $struc->setAdr3($curr->getValue());
      $this->skip();
      break;

    case 'CITY':
      $struc->setCITY($curr->getValue());
      $this->skip();
      break;

    case 'STAE':
      $struc->setStae($curr->getValue());
      $this->skip();
      break;

    case 'POST':
      $struc->setPost($curr->getValue());
      $this->skip();
      break;

    case 'CTRY':
      $struc->setCtry($curr->getValue());
      $this->skip();
      break;

    default:
      throw new GedcomException("Unexepect Tag: " . $curr->getPosition());
  }

}






	/**
	 *	function addressStructure
	 *	- Gedcom version
	 *
	 **/

	public function addressStructure(GedAddressStructure $struc)
	{
  	//throw new GedcomException("** STOP ! **");

		$curr= $this->gfile->current();

		$struc->setAddr($curr->getValue());
    $level= $curr->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'ADR1':
        	  $struc->setAdr1($curr->getValue());
        	  $this->skip();
        	  break;

        	case 'ADR2':
        	  $struc->setAdr2($curr->getValue());
        	  $this->skip();
        	  break;
        	case 'ADR3':
        	  $struc->setAdr3($curr->getValue());
        	  $this->skip();
        	  break;

        	case 'CITY':
        	  $struc->setCITY($curr->getValue());
        	  $this->skip();
        	  break;

        	case 'STAE':
        	  $struc->setStae($curr->getValue());
        	  $this->skip();
        	  break;

        	case 'POST':
        	  $struc->setPost($curr->getValue());
        	  $this->skip();
        	  break;

        	case 'CTRY':
        	  $struc->setCtry($curr->getValue());
        	  $this->skip();
        	  break;



          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getPosition());
        }
      }
      else
      {
       	return;
      }
    }

	}




  	/**
	 *  abstract function mediaStructure()
	 *
	 **/

	abstract protected function mediaStructure(GedMediaStructure $record);



//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************







   /**
   *	function asso()
   *
   **/

  protected function asso()
  {
    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'RELA':
        	  $this->skip();
        	  break;

        	case 'TYPE':
        	  $this->gfile->next();
        	  break;

        	case 'SOUR':
        	  $this->skip();
        	  break;

          case 'NOTE':
            $this->skip();
            break;

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getPosition());
        }
      }
      else
      {
       	return;
      }
    }
  }




   /**
   *	function chan()
   *  - understøtter Gedcom 5.5 - 7.0
   *
   *  <<CHANGE_DATE>> structuren (men ikke den underliggende <<NOTE_STRUCTURE>>) er uforandret gennem alle gedcom versioner
   **/

  protected function chan(GedChangeDateStructure $record)
  {
    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'DATE':
        	  $this->skip();
        	  break;

          case 'NOTE':
            $this->skip();
            break;

          default;
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }
      }
      else
      {
       	return;
      }
    }
  }


   /**
   *	function time()
   *  - understøtter Gedcom 5.5 - 7.0
   **/

  protected function time(GedChangeDateStructure $record)
  {
    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'TIME':
        	  $this->skip();
        	  break;

          default;
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }
      }
      else
      {
       	return;
      }
    }
  }




  /**
   *	function childFamilyLink()
   *
   **/

  protected function childFamilyLink()
  {
    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'PEDI':
        	  $this->gfile->next();
        	  break;

          case 'NOTE':
            $this->skip();
            break;

          default;
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }
      }
      else
      {
       	return;
      }
    }
  }


  /**
   *	function spouseFamilyLink()
   *
   **/

  protected function spouseFamilyLink()
  {
    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
          case 'NOTE':
            $this->skip();
            break;

          default;
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }
      }
      else
      {
       	return;
      }
    }
  }




  /**
   *  function indi_name()
   *
   * */


  public function indi_name()
  {
    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
          case 'NPFX':
          case 'GIVN':
          case 'NICK':
          case 'SPFX':
          case 'SURN':
          case 'NSFX':
            $this->gfile->next();
            break;

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }

      }
      else
        return;
    }
  }



  /**
   *	function noteStructure()
   *  - Gedcom 5.5 - 5.5.5
   *
   *
   **/

  protected function noteStructure(GedInterfaceNoteStructure $record)
  {
    $curr= $this->gfile->current();
    if ($curr->getPointer())
    {
      // Pointer til NoteRecord
      $this->skip();
      return;
    }
  	$usertext= $curr->getValue();

    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'CONC':
        	  $usertext.= $curr->getValue();
            $this->skip();
        	  break;

        	case 'CONT':
        	  $usertext.= $curr->getValue() . "\r\n";
            $this->skip();
        	  break;

          case 'SOUR':
            $this->skip();

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }

      }
      else
      {
        $record->setUserText($usertext);

        return;
      }
    }

  }


  /**
   * function skip()
   *
   **/

  protected function skip()
  {
    $level= $this->gfile->current()->getLevel();
    do
    {
      $this->gfile->next();
    }
    while($level < $this->gfile->current()->getLevel());
  }


}

