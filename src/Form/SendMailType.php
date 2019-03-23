<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SendMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'uk-input',
                    'placeholder' => 'Sujet des émails'
                ],
                'label_attr' => [
                    'class' => 'uk-form-label'
                ]
            ])
            ->add('content', TextareaType::class,[
                'attr' => [
                    'class' => 'uk-textarea ckeditor',
                    'rows' => '5',
                    'placeholder' => 'Contenu des emails'
                ],
                'label_attr' => [
                    'class' => 'uk-form-label'
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
