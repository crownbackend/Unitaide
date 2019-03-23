<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom'
                ],
                'constraints' => [
                    new Assert\Length([
                        'min' => 2,
                        'max' => 180,
                        'minMessage' => 'Votre nom doit contenir au minimum {{ limit }} caractères.',
                        'maxMessage' => 'Votre nom ne doit pas dépasser {{ limit }} caractères.'
                    ]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ],
                'constraints' => [
                    new Assert\Email([
                        'message' => 'Votre email n\'est pas valide'
                    ]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Message',
                    'cols' => 30,
                    'rows' => 7
                ],
                'constraints' => [
                    new Assert\Length([
                        'min' => 30,
                        'minMessage' => 'Votre Message doit contenir au minimum {{ limit }} caractères.',
                    ]),
                    new Assert\NotBlank()
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
