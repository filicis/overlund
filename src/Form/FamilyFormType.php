<?php

namespace App\Form;

use App\Entity\Family;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FamilyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastChange')
            ->add('crea')
            ->add('xref')
            ->add('locked')
            ->add('confidential')
            ->add('privacy')
            ->add('project')
            ->add('husbandRelation')
            ->add('wifeRelation')
            ->add('identifierLink')
            ->add('media')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Family::class,
        ]);
    }
}
