<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Project;
use App\Entity\SourceRecord;

class SourceRecords extends Fixture {

    const SOURCE = array(
        array(
            'Author',
            'Title',
            'Abbreviation',
            'Publication',
            'Text'
        ),
        array(
            'Henning Henningsen',
            '"Papegøje og Vippefyr": Det danske fyrvæsen indtil 1770',
            'Abbreviation',
            '"Handels- og Søfartsmuseet på Kronborg. Årbog" 1960;1-40',
            'Text'
        ),
        array(
            'G.L. Dam og H.K. Larsen',
            'Aakirkeby, 1346-1946',
            'Abbreviation',
            'http://bornholmske-samlinger.dk/wp-content/uploads/2014/10/1346-1946-Aakirkeby.pdf',
            'Text'
        ),
        array(
            'Andersen, Axel',
            'Assistens Kirkegaard, København',
            'Abbreviation',
            'Assistens Kirkegårds Formidlingscenter, 1993.',
            'En lille Tekst'
        ),
    );

    public function load( ObjectManager $manager ): void {

        $project = $manager->getRepository( Project::class )->findAll();

        foreach ( self::SOURCE as $src ) {
            $rec = new SourceRecord();
            $rec->setAuthor( $src[ 0 ] );
            $rec->setTitle( $src[ 1 ] );
            $rec->setAbbreviation( $src[ 2 ] );
            $rec->setPublication( $src[ 3 ] );
            // $rec->setText( $src[ 4 ] );

            //$record->addFileReference( $ref );
            //$project[ 0 ]->addSourceRecord( $rec );
            //$manager->persist( $rec );
        }
        //$manager->persist( $project[ 0 ] );

        //$manager->flush();
    }
}
