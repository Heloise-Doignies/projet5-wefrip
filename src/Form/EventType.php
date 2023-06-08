<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eventName')
            ->add('eventDate')
            ->add('eventDescription')
            ->add('eventImageName')
            ->add('coordinateLat')
            ->add('coordinateLng')
            ->add('eventSlug')
            ->add('eventUpdatedAt')
            ->add('userParticipant')
            ->add('userCreator')
            ->add('typeEvent')
            ->add('infosLocation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
