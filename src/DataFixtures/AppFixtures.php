<?php

namespace App\DataFixtures;

use       Doctrine\Bundle\FixturesBundle\Fixture;
use       Doctrine\Persistence\ObjectManager;

use       App\Entity\User;
use       App\Entity\Project;

use       App\Entity\Individual;

use       App\Entity\PersonalNameStructure;

use       App\Entity\MediaRecord;
use       App\Entity\FileReference;


class AppFixtures extends Fixture
{
  const USERNAME= array('demo', 'michael', 'filicis');
  const PASSWORD= '$2y$13$CA8Wk8FsSKcFiNomYQGR/O71G0LuFGQQxnq6VMquo1YhNltKSJAKO';
  const ROLES= array('ROLE_ADMIN');

  const PROJECT= array('demo', 'project01', 'project02');

  const INDIVIDUAL= array('', '', '', '');
  const NAME= array('', '', '', '');

  const MEDIA= array(
    array('Title 1', '', ''),
    array('Title 2', '', ''),
    array('Title 3', '', ''),
    array('Title 4', '', ''),
  );

  /**
   * function load
   */

    public function load(ObjectManager $manager): void
    {
      // USER

      foreach (self::USERNAME as $name)
      { 
        $user= new User();
        $user->setUsername($name);
        $user->setPassword(self::PASSWORD);
        $user->setRoles(self::ROLES);
        $manager->persist($user);
      }

      // PROJECT

      foreach (self::PROJECT as $url)
      {
        $project= new Project();
        $project->setUrl($url);
        $project->setTitle($url);
        $manager->persist($project);
        $manager->flush();

        $this->individual($project, $manager);
        //$this->media($project, $manager);

        $manager->persist($project);
      }

      //$record= new MediaRecord();
      //$manager->persist($record);


      $manager->flush();
    }


    /**
     *  function individual 
     */

    private function individual($project, ObjectManager $manager)
    {
      foreach (self::INDIVIDUAL as $individual)
      {
        $indi= new Individual();
        $p= $indi->getPersonalNameStructures()->first();
        $p->setSpfx('von');
        $p->setGivn('Anders');
        $p->setSurn('And');

        //$ref= new FileReference();
        //$ref->setTitle($media[0]);

        //$record->addFileReference($ref);
        $project->addIndividual($indi);
        $manager->persist($indi);

        foreach(self::NAME as $name)
        {
          $p= new PersonalNameStructure();
          $p->setGivn('Anders');
          $p->setSurn('And');
          $manager->persist($p);
          $indi->addPersonalNameStructure($p);
        }
        $manager->persist($indi);

      }  

    }
    




    /**
     *  function media 
     */

    private function media($project, ObjectManager $manager)
    {
      foreach (self::MEDIA as $media)
      {
        $record= new MediaRecord();
        //$ref= new FileReference();
        //$ref->setTitle($media[0]);

        //$record->addFileReference($ref);
        $project->addMediaRecord($record);
        $manager->persist($record);
      }  

    }
}
