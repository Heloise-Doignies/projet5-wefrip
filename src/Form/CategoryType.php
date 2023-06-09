<?php

namespace App\Form;

use DateTimeImmutable;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categoryName', EntityType::class,[
                'class'=> 'App\Entity\Category',
            ])
            //->add('categorySlug')
            ->add('categoryUpdatedAt', DateTimeType::class, [
                'widget'=>'single_text',
                'data'=>new DateTimeImmutable(),
            ])
            ->add('tutorials', EntityType::class, [
                'class'=> 'App\Entity\Tutorial',
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
