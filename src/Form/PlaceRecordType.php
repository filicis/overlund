<?php

namespace App\Form;

use App\Entity\PlaceRecord;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceRecordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('rin')
            //->add('lastChange')
            //->add('crea')
            //->add('xref')
            ->add('place')
            ->add('latitude')
            ->add('longitude')
            //->add('project')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlaceRecord::class,
        ]);
    }
}
