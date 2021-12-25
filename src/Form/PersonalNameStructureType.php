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
use       Symfony\Component\Form\Extension\Core\Type\TextType;

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
            ->add('npfx', TextType::class, ['label' => 'Prefix:',])
            ->add('givn', TextType::class, ['label' => 'First names:', 'help' => 'Fornavne'])
            ->add('nick', TextType::class, ['label' => 'Nicknames:',])
            ->add('spfx', TextType::class, ['label' => 'Prefix:',])
            ->add('surn', TextType::class, ['label' => 'Last name:',])
            ->add('nsfx', TextType::class, ['label' => 'Suffix:',])
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
