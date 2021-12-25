<?php

/*
 * This file is part of the Asmild package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace 	App\Utils\ORM;

use					App\Utils\GedOrm;
use					App\Utils\AbstractGedRecord;

	/**
	 *	class GedOrm
	 *
	 **/
	 

class GedOrmDummy implements GedOrm
{

	public function reset()
	{
	  return null;	
	}

	public function flush(){}
	
	public function addMessage(String $message= null, AbstractGedRecord $arg= null)
	{		
	}

	
	
	public function setVERS($arg){}
	public function setFORMVERS($arg){}
	public function setCHAR($arg){}
	public function setDEST($arg){}
	public function setSOUR($arg){}
	public function setSOURVERS($arg){}
	public function setSOURNAME($arg){}
	public function setSOURCORP($arg){}
	public function setSOURDATA($arg){} 
	public function setSOURDATADDATE($arg){}
	public function setSOURDATADCOPR($arg){}
  public function SetCreationDate($arg){}
	public function setSUBM($arg){}
	public function setFILE($arg){}
	public function setLANG($arg){}
	public function setCOPR($arg){}
	public function setDescription($arg){}
	

	
	
	public function newFamGroupRecord()
	{
	  return null;	
	}
	
	public function newIndividualRecord()
	{
	  return null;	
	}
	
	public function newMultimediaRecord()
	{
	  return null;	
	}
	
	public function newNoteRecord()
	{
	  return null;	
	}
	
	public function newPropositoryRecord()
	{
	  return null;	
	}
	
	public function newSubmitterRecord()
	{
	  return null;	
	}
	
	public function newSourceRecord()
	{
	  return null;	
	}
	

	
}