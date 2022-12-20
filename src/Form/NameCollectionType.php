<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Form\NameStructureType;

class NameCollectionType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        ->add( 'names', CollectionType::class, [
            // each entry in the array will be an 'email' field
            'entry_type' => NameStructureType::class,
            // these options are passed to each 'email' type
            'entry_options' => [
                'attr' => [ 'class' => 'email-box' ],
            ],
        ] )
        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            // Configure your form options here
        ] );
    }
}
