<?php

namespace App\DataFixtures;

use App\Entity\Event;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $event = new Event();
        $event -> setEventName('Atelier de couture');
        $event -> setEventDescription('Atelier pour apprendre les bases de la couture avec Henriette. Rdv chez moi samedi, de 14h à 17h.');
            $startDate = new DateTimeImmutable('2023-07-09 14:00:00');
            $endDate = new DateTimeImmutable('2023-07-09 18:00:00');
            $eventInterval = $startDate->diff($endDate);
        $event->setEventDate($eventInterval);
        $event -> setEventImageName('videdressing.jpg');
        $event -> setCoordinateLat('48.8919423');
        $event -> setCoordinateLng('2.3421511');
        $event -> setEventSlug('atelier-de-couture-Henriette');
        // $event -> setTypeEvent('Atelier');
        // $event -> setUserCreator('Henriette');
        // $event -> setInfosLocation('Interphone 1234 - 2ème étage');
        $manager->persist($event);

        // $manager->flush();
    }
}
