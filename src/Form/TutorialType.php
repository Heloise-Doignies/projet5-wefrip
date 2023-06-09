<?php

namespace App\Form;

use App\Entity\Tutorial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tutoName')
            ->add('tutoDescription')
            ->add('tutoFileName')
            ->add('tutoVideoName')
            ->add('tutoImageName')
            ->add('tutoSupportType')
            ->add('tutoSlug')
            ->add('tutoUpdatedAt')
            ->add('tutoFavoris')
            ->add('categories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tutorial::class,
        ]);
    }
}