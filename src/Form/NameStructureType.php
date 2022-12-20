<?php

/**
* This file is part of the Overlund package.
*
* ( c ) Michael Lindhardt Rasmussen <filicis@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
**/

namespace App\Form;

use       App\Entity\NameStructure;
use       App\Form\NamePiecesType;

use       Symfony\Component\Form\AbstractType;
use       Symfony\Component\Form\FormBuilderInterface;
use       Symfony\Component\OptionsResolver\OptionsResolver;
use       Symfony\Component\Form\Extension\Core\Type\TextType;

/**
*  class NameStructureType
*/

class NameStructureType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        ->add( 'personalName', TextType::class, [ 'label' => 'Personal Name', 'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ] ] )
        ->add( 'nameType', TextType::class, [ 'label' => 'Type', 'label_attr' => [ 'class' => 'small' ], 'attr' => [ 'class' => 'form-control-sm shadow' ] ] )
        ->add( 'namePieces', NamePiecesType::class )
        ;
    }

    /**
    *
    */

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => NameStructure::class,
        ] );
    }
}
