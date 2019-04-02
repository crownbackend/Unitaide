<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'uk-input',
                    'placeholder' => 'Titre de l\'article'
                ],
                'label_attr' => [
                    'class' => 'uk-form-label'
                ]
            ])
            ->add('seoDescription', TextType::class, [
                'attr' => [
                    'class' => 'uk-input',
                    'placeholder' => 'Une description qui ne dépasse pas les 154 caractères, elle sera utilisé pour tout ce qui est référencement'
                ]
            ])
            ->add('description', TextareaType::class,[
                'attr' => [
                    'class' => 'uk-textarea',
                    'rows' => '5',
                    'placeholder' => 'Description de l\'article'
                ],
                'label_attr' => [
                    'class' => 'uk-form-label'
                ]

            ])
            ->add('tags', TextType::class, [
                'attr' => [
                    'class' => 'uk-input',
                    'placeholder' => 'Séparez chaque mot par une virgule : paris, bruxelle, rome'
                ]
            ])
            ->add('imageFileMiniature', FileType::class, [
                'required' => false
            ])
            ->add('imageFiles', FileType::class, [
                'multiple' => true,
                'required' => false
            ])
            ->add('category', null, [
                'attr' => [
                    'class' => 'uk-select'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
