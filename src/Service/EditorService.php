<?php

namespace   App\Service;

use       Doctrine\Persistence\ManagerRegistry;
use       Symfony\Component\Uid\Ulid;

use       App\Entity\Family;
use       App\Entity\Individual;
use       App\Entity\Project;

class EditorService
{
  private $entityManager;

  //
  //
  //

  function __construct(ManagerRegistry $doctrine)
  {
    $this->entityManager= $doctrine->getManager();
  }

  //
  //
  //

  public function newFamily(Project $project): ?Ulid
  {
    try
    {
      $fam= new Family();
      $project->addFamily($fam);

      $this->entityManager->persist($project);
      $this->entityManager->persist($fam);
      $this->entityManager->flush();

      return $fam->getId();
    }
    catch(\Exception $e)
    {
    }  
  }  

  //
  //  function newIndividual()
  //

  public function newIndividual(Project $project): ?Ulid
  {
    try
    {
      $indi= new Individual();
      $project->addIndividual($indi);

      $this->entityManager->persist($project);
      $this->entityManager->persist($indi);
      $this->entityManager->flush();

      return $indi->getId();
    }
    catch(\Exception $e)
    {
    }
  }

}


