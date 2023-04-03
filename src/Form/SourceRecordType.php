<?php

/**
* This file is part of the Overlund package.
*
* @author Michael Lindhardt Rasmussen <filicis@gmail.com>
* @copyright 2000-2023 Filicis Software
* @license MIT
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace App\Form;

use App\Entity\SourceRecord;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
* Summary of SourceRecordType
*/

class SourceRecordType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        //->add( 'lastChange' )
        //->add( 'crea' )
        //->add( 'xref' )
        ->add( 'author', TextType::class )
        ->add( 'title', TextType::class )
        ->add( 'Abbreviation', TextType::class )
        ->add( 'publication', TextType::class )
        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => SourceRecord::class,
        ] );
    }
}
