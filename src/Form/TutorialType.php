<?php

namespace App\Form;

use App\Entity\Tutorial;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TutorialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tutoName', TextType::class,[
                'label'=>'Nom du tutoriel',
                ])
            ->add('tutoShortDescription', TextareaType::class, [
                'label'=>'Titre',
                // 'config' => [
                //     'removePlugins' => 'exportpdf',
                // ],
                ])
            ->add('tutoDescription', CKEditorType::class, [
                'label'=>'Description',
                'config' => [
                    'removePlugins' => 'exportpdf',
                ],
                ])
            ->add('tutoFile', FileType::class,[
                'required' => false,
                'label' => 'Visuel du tutoriel (pour un tutoriel "fiche")',
                // 'data_class' => null,
                ])
            ->add('tutoVideoName', TextType::class,[
                'required' => false,
                'label' => 'Lien Youtube (pour un tutoriel "vidéo")',
                'data_class' => null,
                ])
            ->add('tutoSupportType', ChoiceType::class, [
                'label' => 'Type de support',
                'choices' => [
                    'Fiche' => 'Fiche',
                    'Vidéo' => 'Vidéo',
                ],
            ])
            ->add('tutoImageFile', FileType::class,[
                'required' => false,
                'label' => 'Image du tutoriel (pour la miniature)',
                // 'data_class' => null,
                ])
            //->add('tutoSlug')
            ->remove('tutoUpdatedAt', DateTimeType::class, [
                'widget'=>'single_text',
                'data'=>new \DateTimeImmutable(),
                'label' => 'Ajouté le',
            ]) 
            ->add('categories', EntityType::class, [
                'class'=> 'App\Entity\Category',
                'label' => 'Catégorie(s) du tutoriel',
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
