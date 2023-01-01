<?php

namespace App\Form;

use       App\Entity\Family;
use       Symfony\Component\Form\AbstractType;
use       Symfony\Component\Form\Extension\Core\Type\CollectionType;
use       Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use       Symfony\Component\Form\FormBuilderInterface;
use       Symfony\Component\OptionsResolver\OptionsResolver;

class FamilyType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        ->add( 'lastChange' )
        //->add( 'crea' )
        ->add( 'xref' )
        ->add( 'locked', CheckboxType::class, ['label' => 'Test', 'attr' => ['class' => 'btn-check' ], 'label_attr' => ['class' => 'btn btn-sm btn-outline-dark btn-light']] )
        ->add( 'confidential', CheckboxType::class, ['label' => 'Test', 'attr' => ['class' => 'btn-check' ], 'label_attr' => ['class' => 'btn btn-sm btn-outline-dark btn-light']] )
        ->add( 'privacy', CheckboxType::class, ['label' => 'Test', 'attr' => ['class' => 'btn-check' ], 'label_attr' => ['class' => 'btn btn-sm btn-outline-dark btn-light']]  )
        //->add( 'project' )
        //->add( 'husbandRelation' )
        //->add( 'wifeRelation' )
        //->add( 'identifierLink' )
        //->add( 'media' )
        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => Family::class,
        ] );
    }
}
