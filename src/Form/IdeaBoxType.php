<?php

namespace App\Form;

use App\Entity\IdeaBox;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdeaBoxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idea', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Exprimez vous !',
                    'cols' => 30,
                    'rows' => 7
                ]
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre nom ?'
                ]
            ])
            ->add('telephone', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Un numéro ou vous joindre ?'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Un email ou vous joindre ?'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IdeaBox::class,
        ]);
    }
}
