<?php

namespace App\Form;

use App\Entity\SourceRecord;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourceRecordType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        //->add( 'lastChange' )
        //->add( 'crea' )
        ->add( 'xref' )
        ->add( 'author' )
        ->add( 'title' )
        ->add( 'Abbreviation' )
        ->add( 'publication' )
        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => SourceRecord::class,
        ] );
    }
}
