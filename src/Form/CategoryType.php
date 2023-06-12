<?php

namespace App\Form;

use DateTimeImmutable;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categoryName', TextType::class,[
                'label'=> 'Nom de la catégorie',
            ])
            //->add('categorySlug')
            ->add('categoryUpdatedAt', DateTimeType::class, [
                'widget'=>'single_text',
                'data'=>new DateTimeImmutable(),
                'label' => 'Ajouté le',
            ])
            ->add('tutorials', EntityType::class, [
                'class'=> 'App\Entity\Tutorial',
                'label' => 'Tutoriels dans la catégorie',
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
            'data_class' => Category::class,
        ]);
    }
}
