<?php

namespace App\Form;

use App\Entity\User;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            //->add('roles')
            ->add('plainPassword',PasswordType::class,[
                'mapped'=>false,
                'label'=>'Changer le mot de passe',
            ])
            ->add('pseudo', TextType::class,[
                'label'=>'Pseudo',
                ])
            ->add('lastname', TextType::class,[
                'label'=>'Nom de famille',
                ])
            ->add('firstname', TextType::class,[
                'label'=>'Prénom',
                ])
            ->add('avatarName', FileType::class,[
                    'required' => false,
                    'label' => 'Avatar',
                    'data_class' => null,
                ])
            //->add('userSlug')
            // ->add('userUpdatedAt', DateTimeType::class, [
            //     'widget'=>'single_text',
            //     'data'=>new DateTimeImmutable(),
            // ])
            ->remove('userCreator')
            ->remove('participantEvent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
