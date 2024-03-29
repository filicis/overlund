<?php

/**
* This file is part of the Overlund package.
*
* @author Michael Lindhardt Rasmussen <filicis@gmail.com>
* @copyright 2000-2022 Filicis Software
* @license MIT
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\AddressStructure;

class AddressType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        ->add( 'addr', TextType::class )
        ->add( 'adr1', TextType::class )
        ->add( 'adr2', TextType::class )
        ->add( 'adr3', TextType::class )
        ->add( 'post', TextType::class )
        ->add( 'city', TextType::class )
        ->add( 'stae', TextType::class )
        ->add( 'ctry', TextType::class )
        ->add( 'phon', TelType::class )
        ->add( 'email', EmailType::class )
        ->add( 'fax', TelType::class )
        ->add( 'www', UrlType::class )

        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults(
            [
                'data_class' => AddressStructure::class,
                // Configure your form options here
            ] );
        }
    }
