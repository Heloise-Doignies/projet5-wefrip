<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\TypeEvent;
use App\Entity\UserParticipant;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eventName', TextType::class, [
                'label'=>"Nom de l'événement",
            ])
            ->add('eventDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Organisé le',
            ])
            ->add('eventDescription', CKEditorType::class, [
                'label'=>"Description de l'événement",
                'config' => [
                    'removePlugins' => 'exportpdf',
                ],
            ])
            ->add('eventImageName', FileType::class,[
                'required' => false,
                'label' => 'Image de l\'événement',
                ])
            ->add('coordinateLat', HiddenType::class)
            ->add('coordinateLng', HiddenType::class)
            ->remove('eventSlug')
            ->remove('eventUpdatedAt', DateTimeType::class, [
                'widget'=>'single_text',
                'data'=>new \DateTimeImmutable(),
                'label' => 'Ajouté le :',
            ])
            ->remove('userParticipant', EntityType::class, [
                'class' => UserParticipant::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Participant(s) à l\'événement',
            ])
            ->add('userCreator', EntityType::class,[
                'class'=> 'App\Entity\UserCreator',
                'multiple' => false,
                'label' => 'Créateur de l\'événement',
            ])
            ->add('typeEvent', EntityType::class, [
                'class' => TypeEvent::class,
                'choice_label' => 'typeName',
                'label' => 'Type d\'événement',
            ])
            ->remove('infosLocation', EntityType::class,[
                'class'=> 'App\Entity\InfoLocation',
                'label' => 'Informations d\'accès',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
