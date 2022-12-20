<?php

namespace App\Form;

use App\Entity\Individual;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IndividualFormType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        ->add( 'lastChange' )
        ->add( 'crea' )
        ->add( 'xref' )
        ->add( 'sex' )
        ->add( 'locked' )
        ->add( 'confidential' )
        ->add( 'privacy' )
        ->add( 'project' )
        ->add( 'identifierLink' )
        ->add( 'media' )
        ;

        $builder
        ->add( 'names', CollectionType::class, [
            'entry_type' => NameStructure::class,
            'entry_options' => [ 'label' => false ]
        ] );
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => Individual::class,
        ] );
    }
}
