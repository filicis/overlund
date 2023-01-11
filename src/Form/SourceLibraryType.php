<?php

namespace App\Form;

use       App\Entity\Project;
use       Symfony\Component\Form\AbstractType;
use       Symfony\Component\Form\FormBuilderInterface;
use       Symfony\Component\OptionsResolver\OptionsResolver;

use       Symfony\Component\Form\Extension\Core\Type\CollectionType;
use       Symfony\Component\Form\Extension\Core\Type\IntegerType;
use       Symfony\Component\Form\Extension\Core\Type\SearchType;

use       App\Form\SourceRecordType;

class SourceLibraryType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        ->add( 'sourceRecords', CollectionType::class, [ 'entry_type' => SourceRecordType::class,
        'entry_options' => [
            'attr' => [ 'class' => '' ]
        ] ] )
        ->add( 'searchTerm', SearchType::class, [ 'mapped' => false ] )
        ->add( 'page', IntegerType::class, [ 'mapped' => false ] )
        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => Project::class,
        ] );
    }
}
