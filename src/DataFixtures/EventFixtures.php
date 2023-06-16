<?php

namespace App\DataFixtures;

use App\Entity\Event;
use DateTimeImmutable;
use App\Entity\TypeEvent;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EventFixtures extends Fixture
{
    public const VIDEDRESSING = 'vide-dressing';
    public const ATELIER = 'atelier';
        
    public function load(ObjectManager $manager): void
        {
            //Fixtures pour les types d'événements (vide drssing ou atelier)
            $typeEvent = new TypeEvent();
            $typeEvent->setTypeName('Vide dressing');
            $typeEvent->setTypeSlug('vide-dressing');
            $manager->persist($typeEvent);
            $this->addReference(self::VIDEDRESSING, $typeEvent);
    
            $typeEvent = new TypeEvent();
            $typeEvent->setTypeName('Atelier');
            $typeEvent->setTypeSlug('atelier');
            $manager->persist($typeEvent);
            $this->addReference(self::ATELIER, $typeEvent);
    
            //Fixtures pour les événements 
        $event = new Event();
        $event -> setEventName('Atelier de couture');
        $event -> setEventDescription('Atelier pour apprendre les bases de la couture avec Henriette. Rdv chez moi samedi, de 14h à 17h.');
            // $startDate = new DateTimeImmutable('2023-07-09 14:00:00');
            // $endDate = new DateTimeImmutable('2023-07-09 18:00:00');
            // $eventInterval = $startDate->diff($endDate);
            $eventDate = new \DateTime('2023-07-09 14:00:00');
        $event->setEventDate($eventDate);
        $event -> setEventImageName('videdressing.jpg');
        $event -> setCoordinateLat('48.8919423');
        $event -> setCoordinateLng('2.3421511');
        $event -> setEventSlug('atelier-de-couture-Henriette');
        $event -> setTypeEvent($this->getReference(EventFixtures::ATELIER));
        // $event -> setUserCreator('Henriette');
        // $event -> setInfosLocation('Interphone 1234 - 2ème étage');
        $manager->persist($event);

        $event = new Event();
        $event -> setEventName('Vide dressing');
        $event -> setEventDescription('La coloc organise son vide dressing annuel ! Nous sommes trois garçons et nous vendons des vêtements de taille S et M. Dimanche après-midi, jusqu\'à 19h.');
        //     $startDate = new DateTimeImmutable('2023-07-10 14:00:00');
        //     $endDate = new DateTimeImmutable('2023-07-10 19:00:00');
        //     $eventInterval = $startDate->diff($endDate);
        // $event->setEventDate($eventInterval);
            $eventDate = new \DateTime('2023-07-10 14:00:00');
        $event->setEventDate($eventDate);
        $event -> setEventImageName('videdressing.jpg');
        $event -> setCoordinateLat('48.8694901');
        $event -> setCoordinateLng('2.3893574');
        $event -> setEventSlug('vide-dressing-Yani');
        $event -> setTypeEvent($this->getReference(EventFixtures::VIDEDRESSING));
        // $event -> setUserCreator('Yani');
        // $event -> setInfosLocation('Sonnez chez Bachi - 3ème étage');
        $manager->persist($event);

        $manager->flush();
    }
}
