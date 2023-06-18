<?php

namespace App\DataFixtures;

use App\Entity\Tutorial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TutorialFixtures extends Fixture
{
    public const FICHE = 'Fiche';
    public const VIDEO = 'Vidéo';

    public function load(ObjectManager $manager): void
    {
        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Broder un tee shirt');
        $tutorial -> setTutoDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $tutorial -> setTutoVideoName('fixtVideo1.mp4');
        $tutorial -> setTutoImageName('fixtImage1.jpg');
        $tutorial -> setTutoSupportType('Fiche');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('broder-un-tee-shirt');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::BRODERIE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Réparer une fermeture éclair');
        $tutorial -> setTutoDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $tutorial -> setTutoVideoName('fixtVideo2.mp4');
        $tutorial -> setTutoImageName('fixtImage2.jpg');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('reparer-une-fermeture-eclair');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Apprendre à coudre avec une machine');
        $tutorial -> setTutoDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $tutorial -> setTutoVideoName('fixtVideo3.mp4');
        $tutorial -> setTutoImageName('fixtImage3.jpg');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('apprendre-a-coudre-avec-une-machine');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Tie and Dye');
        $tutorial -> setTutoDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $tutorial -> setTutoVideoName('fixtVideo4.mp4');
        $tutorial -> setTutoImageName('fixtImage4.jpg');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('tie-and-dye');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::BRODERIE));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::TEINTURE));
        $manager->persist($tutorial);

        $manager->flush();
    }
}
