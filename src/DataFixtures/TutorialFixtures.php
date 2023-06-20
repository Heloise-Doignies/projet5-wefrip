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
        $tutorial -> setTutoName('DIY T-shirts brodés');
        $tutorial -> setTutoDescription('Aujourd\'hui je vous propose un tutoriel pour personnaliser vos vêtements et les rendre uniques.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/zxsuMNaFVIk');
        $tutorial -> setTutoImageName('fixtImage1.jpg');
        $tutorial -> setTutoSupportType('Fiche');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('broder-un-tee-shirt');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::BRODERIE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Comment réparer la fermeture éclair');
        $tutorial -> setTutoDescription('Comment réparer une fermeture éclair. C\'est plus facile que de remplacer la fermeture à glissière et très économique');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/NhwaMNvrIlc');
        $tutorial -> setTutoImageName('fixtImage2.jpg');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('reparer-une-fermeture-eclair');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('APPRENDRE À COUDRE À LA MACHINE');
        $tutorial -> setTutoDescription(' Apprendre facilement manipuler le tissu pour faire les lignes droites, parallèles, les courbes, les arrondis, les angles à la machine. Et vous allez voir que la couture c’est facile et amusant !');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/CIj4lo9RFo0');
        $tutorial -> setTutoImageName('fixtImage3.jpg');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('apprendre-a-coudre-avec-une-machine');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('17 idées étonnantes de projets DIY upcycling');
        $tutorial -> setTutoDescription('Vous avez de vieux vêtements que vous ne portez plus ? Si vous pensiez les jeter, n\'en faites rien ! On peut réaliser une multitude de d\'objets de déco ou pratiques avec de vieux habits. Regardez !');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/rj8tyaG720c');
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
