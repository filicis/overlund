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

use			  App\Utils\AbstractGedParser;

use				App\GedInterface\GedTree;
use 			App\GedInterface\GedFamilyRecord;
use       App\GedInterface\GedHeaderRecord;
use 			App\GedInterface\GedIndividualRecord;
use 			App\GedInterface\GedNoteRecord;
use 			App\GedInterface\GedMediaRecord;
use 			App\GedInterface\GedPlaceRecord;
use 			App\GedInterface\GedRepositoryRecord;
use 			App\GedInterface\GedSourceRecord;
use 			App\GedInterface\GedSubmitterRecord;

use       App\Gedinterface\GedRecord;

use       App\GedInterface\Structure\GedAddressStructure;
use       App\GedInterface\Structure\GedChangeDateStructure;
use       App\Gedinterface\Structure\GedMediaStructure;
use       App\Gedinterface\Structure\GedNameStructure;
use       App\Gedinterface\Structure\GedSourceCitation;


	/**
	 *	class GedParser551
	 *
	 *	- Understøtter Gedcom version 5.5-1 som beskrevet i
	 *
	 **/


class GedParser551 extends AbstractGedParser
{


//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************


  /**
   *  function familyRecord()
   *
   **/

  public function familyRecord(GedFamilyRecord $recrec)
  {
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {

        	case 'HUSB':
        	case 'WIFE':
        	case 'CHIL':
        	  $this->skip();
        	  break;

          case 'NOTE':
            // $this->note();
            $this->skip();
            break;

					case 'ANUL':
					case 'DIV':
					case 'DIVF':
					case 'CENS':
					case 'MARR':
					case 'NCHI':
					case 'ENGA':
					case '_MARRIED':

            // $this->event();
            $this->skip();
            break;


          case 'CHAN':
            // $this->chan();
            $this->skip();
            break;

          case 'RIN':
            $this->gfile->next();
            break;

          case 'OBJE':
            // $this->multimediaLink();
            // $this->gfile->next();
            $this->skip();
            break;

          case 'SOUR':
          	$this->sourceCitation($recrec->newSourceCitation());
            $this->skip();
            break;

          case 'RESN':
          case 'ORDN':
          case 'SSN':
          case 'ALIA':
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




//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************


protected function parseHeaderRecord(GedHeaderRecord $gedHeaderRecord)
{
  // throw new GedcomException("** STOP **");

  // $this->gfile->next();

  $curr= $this->gfile->current();
  switch($curr->getTag())
  {
    case 'CHAR':
      $gedHeaderRecord->setEncoding($curr->getValue());
     $this->skip();
     break;

    case 'COPR':
      $gedHeaderRecord->setCopr($curr->getValue());
      $this->_parseXX('parseHeadCorp', $gedHeaderRecord);
      //$this->skip();
      break;

/*
    case 'CORP':
      $gedHeaderRecord->setCopr($curr->getValue());
      $this->_parseXX('parseHeadCorp', $gedHeaderRecord);
      //$this->skip();
      break;
*/
    // HEAD.DEST
    // - The system identifier of the system expected to process the GEDCOM file.

    case 'DEST':
      $gedHeaderRecord->setDestination($curr->getValue());
      $this->skip();
      break;

    // HEAD.FILE
    // - The name of the GEDCOM file.

    case 'FILE':
      $gedHeaderRecord->setFilename($curr->getValue());
      $this->skip();
      break;

    case 'FORM':
      $gedHeaderRecord->setForm($curr->getValue());
      $this->skip();
      break;

    // HEAD.LANG
    // - The human language in which the data in the GEDCOM file is normally read or written

    case 'LANG':
      $gedHeaderRecord->setlanguage($curr->getValue());
      $this->skip();
      break;

    // HEAD.SUBM
    // - A pointer to a SUBM Record

    case 'SUBM':
      $this->gfile->next();
      break;


    case 'SOUR':
      // throw new GedcomException("** STOP SOUR **");
      $gedHeaderRecord->setSource($curr->getValue());
      $this->_parseXX('parseHeadSour', $gedHeaderRecord);
      // $this->skip();
      // throw new GedcomException("** STOP SOUR - Tag: "  . $this->gfile->current()->getTag() . "  Pos: " . $this->gfile->current()->getPosition() ." **");
    break;

    case 'GEDC':
      $this->_parseXX('parseHeadGedc', $gedHeaderRecord);
      //$this->skip();
      break;



    case 'CHAR':
    case 'SOUR':
    case 'DATE':
    case 'LANG':
    case 'SUBM':
    case 'FILE':
    case 'COPR':

    case 'NOTE':
      $this->skip();
      break;

    // SUBN er obsolet

    case 'SUBN':
      $this->skip();
      break;


    default:
      throw new GedcomException("Unexpected Tag in Gedcom Header: " . $curr->getTag() . "  Pos: " . $curr->getPosition());

  }

}



  /**
   *  parseChan()
   *
   **/


  protected function parseChan(GedRecord $gedrec)
  {

    $curr= $this->gfile->current();
    switch($curr->getTag())
    {
      case 'DATE':
        $gedrec->setChan("Dags dato");
        $this->skip();
        break;

      case 'NOTE':
        $this->skip();
        break;

      default:
        throw new GedcomException("Unexpected Tag in Gedcom HEAD-CORP: " . $curr->getTag() . "  Pos: " . $curr->getPosition());
    }


  }




  /**
   *  parseHeadCorp()
   *
   **/


  protected function parseHeadCorp(GedHeaderRecord $gedHeaderRecord)
  {

    $curr= $this->gfile->current();
    switch($curr->getTag())
    {
      case 'ADDR':
        $gedHeaderRecord->setAddr($curr->getValue());
        $this->_parseXX('parseAddr', $gedHeaderRecord);
        //$this->skip();
        break;

      default:
        throw new GedcomException("Unexpected Tag in Gedcom HEAD-CORP: " . $curr->getTag() . "  Pos: " . $curr->getPosition());
    }


  }


  /**
   *  parseHeadGedcCorp()
   *
   **/


  protected function parseHeadGedc(GedHeaderRecord $gedHeaderRecord)
  {

    $curr= $this->gfile->current();
    switch($curr->getTag())
    {
      case 'VERS':
        $gedHeaderRecord->setGedcVers($curr->getValue());
        $this->skip();
        break;

      case 'FORM':
        $gedHeaderRecord->setGedcForm($curr->getValue());
        $this->skip();
        break;

      case 'ADDR':
        $gedHeaderRecord->setAddr($curr->getValue());
        $this->_parseXX('parseAddr', $gedHeaderRecord);
        //$this->skip();
        break;


      default:
        throw new GedcomException("Unexpected Tag in Gedcom HEAD-GEDC: " . $curr->getTag() . "  Pos: " . $curr->getPosition());
    }


  }



  /**
   *  parseHeadSour()
   *
   **/


  protected function parseHeadSour(GedHeaderRecord $gedHeaderRecord)
  {
    // throw new GedcomException("** STOP **");

    // $this->gfile->next();

        $curr= $this->gfile->current();
        switch($curr->getTag())
        {

        	case 'VERS':
        	  $this->skip();
        	  break;

        	case 'NAME':
        	  $this->skip();
        	  break;

          case 'CORP':
            $gedHeaderRecord->setCorp($curr->getValue());
            $this->_parseXX('parseHeadCorp', $gedHeaderRecord);
        	  // $this->skip();
            break;

          case 'DATA':
        	  $this->skip();
            break;

          default:
            throw new GedcomException("Unexpected Tag in Gedcom HEAD-SOUR: " . $curr->getTag() . "  Pos: " . $curr->getPosition());

        }


  }



  /**
   *  parseName()
   *
   **/


  protected function parseName(GedNameStructure $gedrec)
  {
    // throw new GedcomException("** STOP **");

    // $this->gfile->next();

        $curr= $this->gfile->current();
        switch($curr->getTag())
        {

        	case 'TYPE':
        	  $gedrec->setType($curr->getValue());
        	  break;

        	case 'NPFX':
        	  $gedrec->setNpfx($curr->getValue());
        	  break;

        	case 'GIVN':
        	  $gedrec->setGivn($curr->getValue());
        	  break;

        	case 'NICK':
        	  $gedrec->setNick($curr->getValue());
        	  break;

        	case 'SPFX':
        	  $gedrec->setSpfx($curr->getValue());
        	  break;

        	case 'SURN':
        	  $gedrec->setSurn($curr->getValue());
        	  break;

        	case 'NSFX':
        	  $gedrec->setNsfx($curr->getValue());
        	  break;

        	case 'NOTE':
        	case 'SOUR':
        	case 'FONE':
        	case 'ROMN':
        	  $this->skip();
        	  break;


          default:
            throw new GedcomException("Unexpected Tag in Gedcom INDI-NAME: " . $curr->getTag() . "  Pos: " . $curr->getPosition());

        }
        $this->skip();


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
   *  function mediaRecord()
   *
   **/

  public function mediaRecord(GedMediaRecord $recrec)
  {
  	$this->skip();

  }


	/**
	 *  abstract function mediaStructure()
	 *
	 **/

	protected function mediaStructure(GedMediaStructure $recrec)
	{}










//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************


  protected function parseIndividualRecord(GedIndividualRecord $gedIndividualRecord)
  {
      $curr= $this->gfile->current();
        switch($curr->getTag())
        {
          case 'ALIA':
        	  //$this->aliaStructure();
            $this->skip();
        	  break;

          case 'ASSO':
            // $this->assoStructure();
            $this->skip();
            break;

						// TODO: chanStructure skal implementerew

          case 'CHAN':
            // $this->_parseXX('parseChan', $gedIndividualRecord);
            // $this->chanStructure();
            $this->skip();
            break;



          case 'ADOP':
          case 'BAPM':
          case 'BARM':
          case 'BASM':
          case 'BIRT':
          case 'BURI':
          case 'CAST':
          case 'CENS':
          case 'CHRA':
          case 'CREM':
          case 'CHR':
          case 'CONF':
          case 'DEAT':
          case 'EMIG':
          case 'EVEN':
          case 'FCOM':
          case 'GRAD':
          case 'IMMI':
          case 'NATU':
          case 'PROB':
          case 'RETI':
          case 'WILL':
            //$this->individualEventStructure();
            $this->skip();
            break;

          case 'CAST':
          case 'DSCR':
          case 'EDUC':
          case 'IDNO':
          case 'NATI':
          case 'NCHI':
          case 'NMR':
          case 'OCCU':
          case 'PROP':
          case 'RELI':
          case 'RESI':
          case 'TITL':
          case 'FACT':
            // $this->individualEventStructure();
            $this->skip();
            break;

         case 'FAMC':
            // $this->famcStructure();
            $this->skip();
            break;



         case 'FAMS':
            // $this->famsStructure();
            $this->skip();
            break;


      	case 'NAME':
      		$rec= $gedIndividualRecord->newNameStructure();
      		 $rec->setName($curr->getValue());
      		 $this->_parseXX('parseName', $rec);
            // $this->nameStructure();
          $this->skip();
           break;


          case 'NOTE':
            // $this->note();
            $this->skip();
            break;

          case 'OBJE':
            // $this->multimediaLink();
            // $this->gfile->next();
            $this->skip();
            break;

          case 'RESN':
            // $recrec->setResn($curr->getValue());
            $this->skip();
            break;



          case 'RIN':
            $gedIndividualRecord->setRin($curr->getValue());
            $this->gfile->next();
            break;


          case 'SEX':
            $gedIndividualRecord->setSex($curr->getValue());
            $this->gfile->next();
            break;


          case 'SOUR':
          	//$this->sourceCitation($recrec->newSourceCitation());
            $this->skip();
            break;

          case 'SUBM':
            //$this->submStructure();
            $this->skip();
            break;

          case 'ORDN':
          case 'SSN':
            $this->skip();
            break;

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }


  }





//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************


  /**
   *  function noteRecord(GedNoteRecord $recrec)
   *  - Gedcom version 5.5.1
   **/

  public function noteRecord(GedNoteRecord $recrec)
  {
    $curr= $this->gfile->current();
    $usertext= $curr->getValue();

    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {
        		// CONT og CONC er en funtionel enhed
        	case 'CONT':
        	  $usertext.= "\r\n";
        	case 'CONC':
        	  $usertext.= $curr->getValue();
            $this->skip();
        	  break;

          case 'CHAN':
            //$this->chan();
            $this->skip();
            break;

          case 'RIN':
            $recrec->setRin($curr->getValue());
            $this->skip();
            break;


          case 'SOUR':
          	$this->sourceCitation($recrec->newSourceCitation());
            $this->skip();
            break;

          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getTag());
        }

      }
      else
      {
        $recrec->setUserText($usertext);
        return;
      }
    }
  }


//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************


  /**
   *	function chan()
   *  - Gedcom version 5.5.1
   **/

  protected function chan(GedChangeDateStructure $recrec)
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
	 *	function SourceCitation()
	 *	- Gedcom version 5.5.1
	 *
	 *	Skal skelne mellem to version af SourceCitation
	 *
	 **/


  protected function SourceCitation(GedSourceCitation $cit)
  {
  	//throw new GedcomException("** STOP ! **");


    $level= $this->gfile->current()->getLevel();
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        	case 'EVEN':
        		$cit->setEven($curr->getValue());
        	  $this->skip();
        	  break;

        	case 'PAGE':
        		$cit->setPage($curr->getValue());
        	  $this->skip();
        	  break;

        	case 'DATA':
        	  $this->SourceCitationData($cit);

        	case 'NOTE':
        	case 'OBJE':
        	  $this->skip();
        	  break;

        	case 'QUAY':
        		$cit->setQuay($curr->getValue());
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
	 *	function SourceCitationData()
	 *	- Gedcom version 5.5.1
	 *
	 *	Skal skelne mellem to version af SourceCitation
	 *
	 **/


  protected function SourceCitationData(GedSourceCitation $cit)
  {
  	//throw new GedcomException("** STOP ! **");


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

        	case 'TEXT':
        	  $this->SourceCitationDataText($cit);
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
	 *	function SourceCitationData()
	 *	- Gedcom version 5.5.1
	 *
	 *	Skal skelne mellem to version af SourceCitation
	 *
	 **/


  protected function SourceCitationDataText(GedSourceCitation $cit)
  {
  	// throw new GedcomException("** STOP ! **");


    $curr= $this->gfile->current();
    $level= $curr->getLevel();
    $usertext= $curr->getValue();
    if (! $usertext)
      $usertext="";

    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($level < $curr->getLevel())
      {
        switch($curr->getTag())
        {
        		// CONT og CONC er en funtionel enhed
        	case 'CONT':
        	  $usertext.= "\r\n";
        	case 'CONC':
        	  $usertext.= $curr->getValue();
            $this->skip();
        	  break;


          default:
            throw new GedcomException("Unexepect Tag: " . $curr->getPosition());
        }
      }
      else
      {
      	$cit->addText($usertext);
       	return;
      }
    }

  }




}

