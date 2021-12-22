<?php

/**
 * This file is part of the Overlund package.
 *
 * (c) Michael Lindhardt Rasmussen <filicis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/


namespace App\Form;

use App\Entity\PersonalNameStructure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalNameStructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('rin')
            // ->add('lastChange')
            // ->add('crea')
            // ->add('xref')
            ->add('personalName')
            ->add('npfx')
            ->add('givn')
            ->add('nick')
            ->add('spfx')
            ->add('surn')
            ->add('nsfx')
            // ->add('individual')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonalNameStructure::class,
        ]);
    }
}
