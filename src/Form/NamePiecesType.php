<?php

namespace App\Form;

use       Symfony\Component\Form\AbstractType;
use       Symfony\Component\Form\FormBuilderInterface;
use       Symfony\Component\OptionsResolver\OptionsResolver;
use       Symfony\Component\Form\Extension\Core\Type\TextType;

use       App\Entity\NamePieces;

class NamePiecesType extends AbstractType {

    const ATTR = "'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ]";

    /**
    *
    */

    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        ->add( 'npfx', TextType::class, [ 'label' => 'Prefix',  'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ] ] )
        ->add( 'givn', TextType::class, [ 'label' => 'First names', 'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ] ] )
        ->add( 'nick', TextType::class, [ 'label' => 'Nicknames', 'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ] ] )
        ->add( 'spfx', TextType::class, [ 'label' => 'Prefix',  'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ] ] )
        ->add( 'surn', TextType::class, [ 'label' => 'Last name', 'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ] ] )
        ->add( 'nsfx', TextType::class, [ 'label' => 'Suffix',  'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ] ] )
        ;
    }

    /**
    *
    */

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => NamePieces::class,
        ] );
    }
}
