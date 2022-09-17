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

use       App\Entity\Project;
use       Symfony\Component\Form\AbstractType;
use       Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use       Symfony\Component\Form\Extension\Core\Type\FileType;
use       Symfony\Component\Form\Extension\Core\Type\TextType;
use       Symfony\Component\Form\FormBuilderInterface;
use       Symfony\Component\OptionsResolver\OptionsResolver;

use       Symfony\Component\Validator\Constraints\File;

  /**
   *
   **/

class GedcomImportType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('gedcom', FileType::class, [
        'label' => "Gedcom file",
        'required' => true,
        'mapped' => false,
        'constraints' => [
          new File([
            'maxSize' => '500M',
            //'mimeTypes' => [
            //  'application/octet-stream',

            // ],
            'mimeTypesMessage' => 'Please upload a valid GEDCOM file', ])],])
      ->add('autodetect', ChoiceType::class, [
        'label' => 'Autodetect',
        'mapped' => false,
        'expanded' => true,
        'data' => 'yes',
        //'empty_data' => 'Yes',
        'choices' => ['Yes' => 'yes', 'No' => 'no']     ])
      ->add('encoding', TextType::class, [
        'label' => "Character Set",
        'data' => 'UTF8',
        'mapped' => false
          ,])
      ->add('terminator', ChoiceType::class, [
        'label' => "Line Terminator",
        'mapped' => false,
        'expanded' => true,
        'multiple' => false,
        'data' => 'dos',
        'choices' => ['Dos' => 'dos', 'Unix' => 'unix', 'Mac' => 'mac']
        ,])

      ;
  }


  /**
   *
   *
   **/

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
    'data_class' => Project::class,
    ]);
  }
}
