<?php

namespace App\DataFixtures;

use App\Entity\Tutorial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TutorialFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Broder un tee shirt');
        $tutorial -> setTutoDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $tutorial -> setTutoVideoName('fixtVideo1.mp4');
        $tutorial -> setTutoImageName('fixtImage1.jpg');
        $tutorial -> setTutoSupportType('Fiche');
        $tutorial -> setTutoSlug('broder-un-tee-shirt');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::CUSTOMISATION));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Réparer une fermeture éclair');
        $tutorial -> setTutoDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $tutorial -> setTutoVideoName('fixtVideo2.mp4');
        $tutorial -> setTutoImageName('fixtImage2.jpg');
        $tutorial -> setTutoSupportType('Vidéo');
        $tutorial -> setTutoSlug('reparer-une-fermeture-eclair');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Apprendre à coudre avec une machine');
        $tutorial -> setTutoDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $tutorial -> setTutoVideoName('fixtVideo3.mp4');
        $tutorial -> setTutoImageName('fixtImage3.jpg');
        $tutorial -> setTutoSupportType('Fiche');
        $tutorial -> setTutoSlug('apprendre-a-coudre-avec-une-machine');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Tie and Dye');
        $tutorial -> setTutoDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $tutorial -> setTutoVideoName('fixtVideo4.mp4');
        $tutorial -> setTutoImageName('fixtImage4.jpg');
        $tutorial -> setTutoSupportType('Vidéo');
        $tutorial -> setTutoSlug('tie-and-dye');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::CUSTOMISATION));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::TEINTURE));
        $manager->persist($tutorial);

        $manager->flush();
    }
}
