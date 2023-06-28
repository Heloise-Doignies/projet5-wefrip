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
        $tutorial -> setTutoShortDescription('Comment rendre un vêtement unique');
        $tutorial -> setTutoDescription("Aujourd'hui je vous propose un tutoriel pour personnaliser vos vêtements et les rendre uniques.");
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
        $tutorial -> setTutoShortDescription('Réparer une fermeture en un éclair!');
        $tutorial -> setTutoDescription("Comment réparer une fermeture éclair. C'est plus facile que de remplacer la fermeture à glissière et très économique");
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/NhwaMNvrIlc');
        $tutorial -> setTutoImageName('fermeture-eclair.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('reparer-une-fermeture-eclair');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::REPARATION));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Apprendre à coudre à la machine');
        $tutorial -> setTutoShortDescription('Connaître les bases de la couture!');
        $tutorial -> setTutoDescription(" Apprendre facilement manipuler le tissu pour faire les lignes droites, parallèles, les courbes, les arrondis, les angles à la machine. Et vous allez voir que la couture c'est facile et amusant !");
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/CIj4lo9RFo0');
        $tutorial -> setTutoImageName('machineacoudre.jpg');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('apprendre-a-coudre-avec-une-machine');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('17 idées étonnantes de projets DIY upcycling');
        $tutorial -> setTutoShortDescription('Donnez une seconde vie à vos vêtements! ');
        $tutorial -> setTutoDescription("Vous avez de vieux vêtements que vous ne portez plus ? Si vous pensiez les jeter, n'en faites rien ! On peut réaliser une multitude de d'objets de déco ou pratiques avec de vieux habits. Regardez !");
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
        $tutorial -> setTutoShortDescription("Éponge tawashi : un tuto facile pour fabriquer sa propre lavette zéro déchet.");
        $tutorial -> setTutoDescription("<p>Connaissez-vous l'éponge tawashi, cette lavette en tissu économique, écologique et zéro déchet ? Découvrez dans ce tuto comment fabriquer votre propre tawashi à la maison en recyclant vos vieux vêtements !</p>
        <ol>Comment fabriquer un tawashi au métier à tisser ? Les étapes :
        <li>/ A l'aide d'un crayon gras, tracez un carré au centre de votre planche de bois (environ 16 centimètres).</li>
        <li>/ Tracez des repères tous les 2 centimètres, un pour chaque clou (20 en tout).</li>
        <li>/ Enfoncez vos clous de manière à obtenir une rangée régulière de 5 clous sur chaque face du carré. Laissez un espace vide aux 4 coins du carrés.</li>
        <li>/ Découpez la manche d'un pull ou d'un collant/leggings ou autre vêtement légèrement élastique de manière à obtenir 10 fines bandelettes (environ 16 cm de haut). Vous pouvez utiliser des vêtements de couleur différentes pour obtenir un tawashi multicolore.</li>
        <li>/ Enfilez les 5 premières bandelettes sur les rangées de clous de gauche et de droite, à l'horizontale.</li></ol>");
        $tutorial -> setTutoImageName('tawashi.jpg');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('eponge-tawashi');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::MAISON));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Faire un tapis de bain');
        $tutorial -> setTutoShortDescription('Réutiliser ses vieux vêtements!');
        $tutorial -> setTutoDescription('Fabriquer un tapis de bain avec des vieilles serviettes');
        $tutorial -> setTutoImageName('tapisdebain.jpg');
        $tutorial -> setTutoFileName('tapisdebain.jpg');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('faire-un-tapis-de-bain');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::MAISON));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::ACCESSOIRES));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Créez vos propres caches-pots en quelques étapes!');
        $tutorial -> setTutoShortDescription('Rendez unique votre intérieur!');
        $tutorial -> setTutoDescription("Plutôt que d'acheter des caches-pots ordinaires, pourquoi ne pas en créer vous-même ? Dans ce tutoriel, nous allons vous montrer comment fabriquer des caches-pots personnalisés qui ajouteront une touche d'originalité à votre décoration. Avec quelques matériaux simples et un peu de créativité, vous pouvez transformer des pots de fleurs ordinaires en pièces uniques et élégantes.");
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/CSHjBNFd5H4');
        $tutorial -> setTutoImageName('cache-pot.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('cache-pot');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::MAISON));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::ACCESSOIRES));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName('Ravissante robe pour la mi-saison');
        $tutorial -> setTutoShortDescription('Patron gratuit');
        $tutorial -> setTutoDescription('Pour tout âge, un patron pour créer une jolie robe parfaite pour la mi-saison.');
        $tutorial -> setTutoImageName('patron4.png');
        $tutorial -> setTutoFileName('patron4.png');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('patron-robe');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::PATRON));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Patron pour faire une jolie robe d'été");
        $tutorial -> setTutoShortDescription("Portez des vêtements uniques toute l'année");
        $tutorial -> setTutoDescription('Créer facilement votre belle robe sans manches avec ce patron.');
        $tutorial -> setTutoImageName('patron5.png');
        $tutorial -> setTutoFileName('patron5.png');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('patron-robe1');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::PATRON));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Tutoriel pour tricoter un lapin");
        $tutorial -> setTutoShortDescription('Rien de mieux que du fait maison!');
        $tutorial -> setTutoDescription('Un doudou tout doux fait main qui ravira les enfants.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/6KgyvNKNztY');
        $tutorial -> setTutoImageName('tricot1.png');
        $tutorial -> setTutoFileName('tricot1.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('tricot-lapin');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::TRICOT));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Chaperon Rouge");
        $tutorial -> setTutoShortDescription('Jolie cape comme celle qui rendait visite à mère-grand!');
        $tutorial -> setTutoDescription('Tricoter cette jolie cape pour enfants qui saura apporter douceur et confort pour la mi-saison.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/8wzqTN1dnjM');
        $tutorial -> setTutoImageName('tricot3.png');
        $tutorial -> setTutoFileName('tricot3.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('tricot-cape');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::TRICOT));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Mettez de la couleur dans vos vêtements");
        $tutorial -> setTutoShortDescription('Vêtements arc-en-ciel!');
        $tutorial -> setTutoDescription('Comment teindre ses vêtements rapidement dans ce tuto facile et possible avec les enfants.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/yN4XcXT-rE8');
        $tutorial -> setTutoImageName('tie-and-dye.png');
        $tutorial -> setTutoFileName('tie-and-dye.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('tie-and-dye');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::TEINTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Voir la vie en bleue");
        $tutorial -> setTutoShortDescription('Mettez une touche de bleue dans votre vie!');
        $tutorial -> setTutoDescription('Tutoriel pour teindre ses vêtements en bleu.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/S-5gxvKn81s');
        $tutorial -> setTutoImageName('teinte-bleue.png');
        $tutorial -> setTutoFileName('teinte-bleue.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('teinture-bleu');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::TEINTURE));
        $manager->persist($tutorial);
        
        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Teindre ses taies d'oreillers");
        $tutorial -> setTutoShortDescription('Egayez votre intérieur!');
        $tutorial -> setTutoDescription("Rapide, facile cette fiche pour teindre vos taies d'oreillers et voir la vie en couleurs.");
        $tutorial -> setTutoImageName('fiche-teinture.png');
        $tutorial -> setTutoFileName('fiche-teinture.png');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('fiche-teinture');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::TEINTURE));
        $manager->persist($tutorial);
        
        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Faire un ourlet rapidement");
        $tutorial -> setTutoShortDescription('Plus besoin de demander à mamie!');
        $tutorial -> setTutoDescription('Tutoriel pour faire un ourlet rapidement et simplement.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/i3Xp8Cf44xU');
        $tutorial -> setTutoImageName('ourlet.png');
        $tutorial -> setTutoFileName('ourlet.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('ourlet');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::REPARATION));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Fiche technique pour faire un joli cabas");
        $tutorial -> setTutoShortDescription('Etre à la pointe de la mode!');
        $tutorial -> setTutoDescription("Parfait pour faire ses courses alliant écologie et économie!");
        $tutorial -> setTutoImageName('patron3.png');
        $tutorial -> setTutoFileName('patron3.png');
        $supportType = self::FICHE; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('patron-cabas');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::PATRON));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::ACCESSOIRES));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Une jolie broderie sur n'importe quel vêtement");
        $tutorial -> setTutoShortDescription('Customisez votre garde-robe!');
        $tutorial -> setTutoDescription('Styliser rapidement un vêtement avec ce tuto de broderie pour débutant.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/30-CdITXC-M');
        $tutorial -> setTutoImageName('broder-facile.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('broderie-facile');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::BRODERIE));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Adopter un look à votre image");
        $tutorial -> setTutoShortDescription('Stylisez votre garde-robe avec un coup de ciseau!');
        $tutorial -> setTutoDescription('Simple, rapide avec juste une paire de ciseaux ce tutoriel vous montrera comment rendre unique chaque pièce de votre armoire.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/XtEL6f7JskQ');
        $tutorial -> setTutoImageName('cut-out.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('cut-out');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::COUTURE));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::PATRON));
        $manager->persist($tutorial);

        $tutorial = new Tutorial();
        $tutorial -> setTutoName("Faire de ses coquilles d'oeufs une déco");
        $tutorial -> setTutoShortDescription('Ravissante déco pour la maison à faire avec ses enfants');
        $tutorial -> setTutoDescription('Court tuto pour faire un atelier DIY en famille.');
        $tutorial -> setTutoVideoName('https://www.youtube.com/embed/Ow1OjIKyH94');
        $tutorial -> setTutoImageName('mini-vase.png');
        $tutorial -> setTutoFileName('mini-vase.png');
        $supportType = self::VIDEO; 
        $tutorial->setTutoSupportType($supportType);
        $tutorial -> setTutoSlug('mini-vase');
        $tutorial -> addCategory($this->getReference(CategoryFixtures::MAISON));
        $tutorial -> addCategory($this->getReference(CategoryFixtures::ACCESSOIRES));
        $manager->persist($tutorial);

        $manager->flush();
    }
}
