<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eventName')
            ->add('eventDate')
            ->add('eventDescription', CKEditorType::class)
            ->add('eventImageName', FileType::class,[
                'required' => false,
                'label' => 'Image de l\'evenement'
                ])

            //->add('coordinateLat')
            //->add('coordinateLng')
            //->add('eventSlug')
            ->add('eventUpdatedAt', DateTimeType::class, [
                'widget'=>'single_text',
                'data'=>new \DateTimeImmutable(),
            ])
            ->add('userParticipant', EntityType::class,[
                'class'=> 'App\Entity\UserParticipant',
            ])
            ->add('userCreator', EntityType::class,[
                'class'=> 'App\Entity\UserCreator',
            ])
            ->add('typeEvent', EntityType::class,[
                'class'=> 'App\Entity\Event',
            ])
            ->add('infosLocation', EntityType::class,[
                'class'=> 'App\Entity\InfoLocation',
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
