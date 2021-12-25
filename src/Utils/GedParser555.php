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

use       App\Gedinterface\Structure\GedMediaStructure;




	/**
	 *	class GedParser555
	 *
	 *	- Understøtter Gedcom version 5.5.5 som beskrevet i
	 *
	 **/


class GedParser555 extends AbstractGedParser
{
  
  
  
  //*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************


  /**
   *  function familyRecord()
   *
   **/

  public function familyRecord(GedFamilyRecord $record)
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
            $this->skip();
            break;

          case 'SOUR':
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


  
  
    /**
   *  function headerRecord()
   *
   **/

  protected function headerRecord(GedHeaderRecord $hdr)
  {
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {
        		// HEAD.CHAR
        		// - [ UTF-8 | UNICODE | ANSEL | ASCII ]
        		// - Anvendes ikke yderligere i programmet
        		
        	case 'CHAR':
            // $this->orm->setCHAR($curr->getValue());
        	  $this->skip();
        	  continue 2;
        	  
        	  // HEAD.COPY
        	  // - Et simpelt tekst felt
        	  	
        	case 'COPR':
            // $this->orm->setCOPR($curr->getValue());
            break;
            
            // HEAD.DEST
            // - The system identifier of the system expected to process the GEDCOM file.
        	
          case 'DEST':
            // $this->orm->setDEST($curr->getValue());
            // $this->gfile->next();
            break;  

						// HEAD.FILE
						// - The name of the GEDCOM file.
						
          case 'FILE':
            // $this->orm->setFILE($curr->getValue());
            // $this->gfile->next();
            break;  

						// HEAD.LANG
						// - The human language in which the data in the GEDCOM file is normally read or written
          
          case 'LANG':
            // $this->orm->setLANG($curr->getValue());
            // $this->gfile->next();
            break;
            
          	// HEAD.SUBM
          	// - A pointer to a SUBM Record  
            
          case 'SUBM':  
            // $this->orm->setSUBM($curr->getPointer());
            // $this->gfile->next();
            break;
          
            
          case 'SOUR':
            // $this->orm->setSOUR($curr->getValue());
            $this->skip();
            continue 2;

          case 'GEDC':
          case 'CHAR':
          case 'SOUR':
          case 'DATE':
          case 'LANG':
          case 'SUBM':
          case 'FILE':
          case 'COPR':

          case 'NOTE':
            $this->skip();
            continue 2;  
            
            // SUBN er obsolet
            
          case 'SUBN':
            $this->skip();
            // break;
            continue 2;      


          default:
            throw new GedcomException("Unexpected Tag in Gedcom Header: " . $curr->getTag());

        }
        $this->gfile->next();

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

  public function mediaRecord(GedMediaRecord $record)
  {
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {
        	
        	case 'FILE':
        	  $this->skip();
        	  break;

        	case 'NOTE':
        	  $this->skip();
        	  break;
        	
          case 'CHAN':
            $this->chan();
            break;

          case 'RIN':
            $this->gfile->next();
            break;


          case 'SOUR':
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
	 *  abstract function mediaStructure()
	 *
	 **/
	 
	protected function mediaStructure(GedMediaStructure $record)
	{}
	




	
	
  /**
   *	function noteStructure()
   *
   *	- Adskiller sig fra tidligere versioner ved ikke at understøtte SOUR
   *
   **/  

  protected function noteStructure(GedInterfaceNoteStructure $record)
  {
  	$result= array("Link" => "", "Text" => "");
  	
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
            $result["Text"]->append($curr->getLevel);
            $this->gfile->next();
          case 'CONT':
            $result["Text"]->append($curr->getLevel());
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


	
//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************


  /**
   *  function individualRecord()
   *
   **/

  public function individualRecord(GedIndividualRecord $record)
  {
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {
          case 'NOTE':
            // $this->note();
            $this->skip();
            break;

      case 'NAME':
            $this->indi_name();
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
            // $this->event();
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
            // $this->event();
            $this->skip();
            break;


          case 'SEX':
            $this->gfile->next();
            break;

          case 'FAMS':
            $this->spouseFamilyLink();
            break;
         case 'FAMC':
            $this->childFamilyLink();
            break;

          case 'CHAN':
            $this->chan();
            break;

          case 'RIN':
            $this->gfile->next();
            break;

          case 'OBJE':
            $this->skip();
            break;

          case 'ASSO':
            $this->asso();
            break;

          case 'SOUR':
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


  /**
   *  function noteRecord(GedNoteRecord $record)
   *
   **/

  public function noteRecord(GedNoteRecord $record)
  {
    $this->gfile->next();
    while($this->gfile->valid())
    {
      $curr= $this->gfile->current();
      if ($curr->getLevel() == 1)
      {
        switch($curr->getTag())
        {

        	case 'CONC':
        	case 'CONT':
        	  $this->skip();
        	  break;
        	
          case 'CHAN':
            $this->chan();
            break;

          case 'RIN':
            $this->gfile->next();
            break;


          case 'SOUR':
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


	
}

