<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'Mot de passe*', 'attr' => ['placeholder' => "Entrer un mot de passe"]],
                'second_options' => ['label' => 'Confirmer mot de passe*','attr' => ['placeholder' => "Confirmer le mot de passe"]], 
                'mapped' => false, 
                        'constraints' => [
                    new NotBlank([
                        'message' => 'Entre ton mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ton mot de passe doit avoir une longueur minimum de {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ], 
            ])

            ->add('pseudo', TextType::class, [
                'required' => false,
                'label' => 'Pseudo',
            ])
            ->remove('lastname', TextType::class, [
                'required' => false,
                'label' => 'Nom de famille',
            ])
            ->remove('firstname', TextType::class, [
                'required' => false,
                'label' => 'Prénom',
            ])

            ->add('avatarFile', FileType::class, [
                'required' => false,
                'label' => 'Avatar',
                'data_class' => null,
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'label'=>"En m'inscrivant, j'accepte les conditions générales d'utilisation et la politique de confidentialité. Nous protégeons vos données.",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Tu dois accepter nos conditions.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
