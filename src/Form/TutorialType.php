<?php

namespace App\Form;

use DateTimeImmutable;
use App\Entity\Tutorial;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TutorialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tutoName')
            ->add('tutoDescription', CKEditorType::class)
            ->add('tutoFileName', FileType::class,[
                'required' => false,
                'label' => 'Image du document'
                ])
            ->add('tutoVideoName', FileType::class,[
                'required' => false,
                'label' => 'Image de la video'
                ])
            ->add('tutoImageName', FileType::class,[
                'required' => false,
                'label' => 'Image du tuto'
                ])
            ->add('tutoSupportType')
            //->add('tutoSlug')
            ->add('tutoUpdatedAt', DateTimeType::class, [
                'widget'=>'single_text',
                'data'=>new DateTimeImmutable(),
            ])
            ->add('tutoFavoris')
            ->add('categories', EntityType::class, [
                'class'=> 'App\Entity\Category',
                'multiple'=> true,
                'attr'=>[
                    "class"=>"select2",
                    "id"=>"select2-tutorials",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tutorial::class,
        ]);
    }
}
