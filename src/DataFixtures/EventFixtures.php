<?php

namespace App\DataFixtures;

use App\Entity\Event;
use DateTimeImmutable;
use App\Entity\TypeEvent;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EventFixtures extends Fixture
{
    public const VIDEDRESSING = 'Vide-dressing';
    public const ATELIER = 'Atelier';
        
    public function load(ObjectManager $manager): void
        {
            //Fixtures pour les types d'événements (vide drssing ou atelier)
            $typeEvent = new TypeEvent();
            $typeEvent->setTypeName('Vide-dressing');
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
            $eventDate = new \DateTime('2023-09-09 14:00:00');
        $event->setEventDate($eventDate);
        $event -> setEventImageName('videdressing.jpg');
        $event -> setCoordinateLat('48.8919423');
        $event -> setCoordinateLng('2.3421511');
        $event -> setEventSlug('atelier-de-couture-Henriette');
        $event -> setTypeEvent($this->getReference(EventFixtures::ATELIER));
        $event -> setInfoLocation('Interphone 1234 - 2ème étage');
        $manager->persist($event);

        $event = new Event();
        $event -> setEventName('Vide-dressing des colocs');
        $event -> setEventDescription('La coloc organise son vide dressing annuel ! Nous sommes trois garçons et nous vendons des vêtements de taille S et M. Dimanche après-midi, jusqu\'à 19h.');
            $eventDate = new \DateTime('2023-09-10 14:00:00');
        $event->setEventDate($eventDate);
        $event -> setEventImageName('videdressing.jpg');
        $event -> setCoordinateLat('48.8694901');
        $event -> setCoordinateLng('2.3893574');
        $event -> setEventSlug('vide-dressing-Yani');
        $event -> setTypeEvent($this->getReference(EventFixtures::VIDEDRESSING));
        $event -> setInfoLocation('Sonnez chez Bachi - 3ème étage');
        $manager->persist($event);

        $event = new Event();
        $event -> setEventName('Vide-dressing pour les enfants');
        $event -> setEventDescription('J\'organise avec des amis un vide-dressing pour les enfants. Des vêtements pour garçons et filles, de 3 ans à 10 ans.');
            $eventDate = new \DateTime('2023-07-10 14:00:00');
        $event->setEventDate($eventDate);
        $event -> setEventImageName('');
        $event -> setCoordinateLat('48.8449496');
        $event -> setCoordinateLng('2.3422593');
        $event -> setEventSlug('vide-dressing-enfants');
        $event -> setTypeEvent($this->getReference(EventFixtures::VIDEDRESSING));
        $event -> setInfoLocation('Envoyez-moi un message au 0606060606 pour avoir les informations.');
        $manager->persist($event);

        $manager->flush();
    }
}
