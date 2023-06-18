<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    //On associe l'instance de l'autre à une référence pour pouvoir récupérer dans une autre fixture
    public const MAISON = 'maison';
    public const COUTURE = 'couture';
    public const REPARATION = 'réparation';
    public const TEINTURE = 'teinture';
    public const ACCESSOIRES = 'accessoires';
    public const PATRON = 'patron';
    public const TRICOT = 'tricot';
    public const BRODERIE = 'broderie';

    public function load(ObjectManager $manager): void
    {

        $category = new Category();
        $category->setCategoryName('Maison');
        $category->setCategoryImageName('maison.png');
        $category->setCategorySlug('maison');
        $manager->persist($category);
        $this->addReference(self::MAISON, $category);

        $category = new Category();
        $category->setCategoryName('Couture');
        $category->setCategoryImageName('Réparation.jpg');
        $category->setCategorySlug('couture');
        $manager->persist($category);
        $this->addReference(self::COUTURE, $category);

        $category = new Category();
        $category->setCategoryName('Réparation');
        $category->setCategoryImageName('couture.jpg');
        $category->setCategorySlug('reparation');
        $manager->persist($category);
        $this->addReference(self::REPARATION, $category);

        $category = new Category();
        $category->setCategoryName('Teinture');
        $category->setCategoryImageName('Teinture.jpg');
        $category->setCategorySlug('teinture');
        $manager->persist($category);
        $this->addReference(self::TEINTURE, $category);

        $category = new Category();
        $category->setCategoryName('Accessoires');
        $category->setCategoryImageName('Accessoires.jpg');
        $category->setCategorySlug('accessoires');
        $manager->persist($category);
        $this->addReference(self::ACCESSOIRES, $category);

        $category = new Category();
        $category->setCategoryName('Patron');
        $category->setCategoryImageName('patron.png');
        $category->setCategorySlug('patron');
        $manager->persist($category);
        $this->addReference(self::PATRON, $category);

        $category = new Category();
        $category->setCategoryName('Tricot');
        $category->setCategoryImageName('tricot.png');
        $category->setCategorySlug('tricot');
        $manager->persist($category);
        $this->addReference(self::TRICOT, $category);

        $category = new Category();
        $category->setCategoryName('Broderie');
        $category->setCategoryImageName('broderie.png');
        $category->setCategorySlug('broderie');
        $manager->persist($category);
        $this->addReference(self::BRODERIE, $category);

        $manager->flush();
    }
}
