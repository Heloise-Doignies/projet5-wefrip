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
        $tutorial -> setTutoImageName('broderie.png');
        $tutorial -> setTutoSupportType('Vidéo');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('broder-un-tee-shirt');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::BRODERIE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Comment réparer une fermeture éclair');
        $tutorial -> setTutoDescription('Comment réparer une fermeture éclair. C\'est plus facile que de remplacer la fermeture à glissière et très économique');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/NhwaMNvrIlc');
        $tutorial -> setTutoImageName('fermeture-eclair.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('reparer-une-fermeture-eclair');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::REPARATION));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Apprendre à coudre à la machine');
        $tutorial -> setTutoDescription(' Apprendre facilement manipuler le tissu pour faire les lignes droites, parallèles, les courbes, les arrondis, les angles à la machine. Et vous allez voir que la couture c’est facile et amusant !');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/CIj4lo9RFo0');
        $tutorial -> setTutoImageName('machineacoudre.jpg');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('apprendre-a-coudre-avec-une-machine');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('17 idées étonnantes de projets DIY upcycling');
        $tutorial -> setTutoDescription('Vous avez de vieux vêtements que vous ne portez plus ? Si vous pensiez les jeter, n\'en faites rien ! On peut réaliser une multitude de d\'objets de déco ou pratiques avec de vieux habits. Regardez !');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/rj8tyaG720c');
        $tutorial -> setTutoImageName('astuces.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('tie-and-dye');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::MAISON));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::ACCESSOIRES));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Éponge tawashi : fabriquer sa lavette zéro déchet');
        $tutorial -> setTutoDescription('Éponge tawashi : un tuto facile pour fabriquer sa propre lavette zéro déchet. 
        <br>Connaissez-vous l’éponge tawashi, cette lavette en tissu économique, écologique et zéro déchet ? Découvrez dans ce tuto comment fabriquer votre propre tawashi à la maison en recyclant vos vieux vêtements !
        <br><b>Comment fabriquer un tawashi au métier à tisser ? Les étapes :</b>
        <br>1/ A l’aide d’un crayon gras, tracez un carré au centre de votre planche de bois (environ 16 centimètres).
        <br>2/ Tracez des repères tous les 2 centimètres, un pour chaque clou (20 en tout).
        <br>3/ Enfoncez vos clous de manière à obtenir une rangée régulière de 5 clous sur chaque face du carré. Laissez un espace vide aux 4 coins du carrés.
        <br>4/ Découpez la manche d’un pull ou d’un collant/leggings ou autre vêtement légèrement élastique de manière à obtenir 10 fines bandelettes (environ 16 cm de haut). Vous pouvez utiliser des vêtements de couleur différentes pour obtenir un tawashi multicolore.
        <br>5/ Enfilez les 5 premières bandelettes sur les rangées de clous de gauche et de droite, à l’horizontale.');
        $tutorial -> setTutoImageName('tawashi.jpg');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('eponge-tawashi');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::MAISON));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Faire un tapis de bain');
        $tutorial -> setTutoDescription('Fabriquer un tapis de bain avec des vieilles serviettes');
        $tutorial -> setTutoImageName('tapisdebain.jpg');
        $tutorial -> setTutoFileName('tapisdebain.jpg');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('faire-un-tapis-de-bain');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::MAISON));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::ACCESSOIRES));
        $manager->persist($tutorial);

        $manager->flush();
    }
}
