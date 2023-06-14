<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    //On associe l'instance de l'autre à une référence pour pouvoir récupérer dans une autre fixture
    public const CUSTOMISATION = 'customisation';
    public const COUTURE = 'couture';
    public const REPARATION = 'reparation';
    public const TEINTURE = 'teinture';
    public const ACCESSOIRES = 'accessoires';

    public function load(ObjectManager $manager): void
    {

        $category = new Category();
        $category->setCategoryName('Customisation');
        $category->setCategoryImageName('customisation.jpg');
        $category->setCategorySlug('customisation');
        $manager->persist($category);
        $this->addReference(self::CUSTOMISATION, $category);

        $category = new Category();
        $category->setCategoryName('Couture');
        $category->setCategoryImageName('couture.jpg');
        $category->setCategorySlug('couture');
        $manager->persist($category);
        $this->addReference(self::COUTURE, $category);

        $category = new Category();
        $category->setCategoryName('Réparation');
        $category->setCategoryImageName('Réparation.jpg');
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

        $manager->flush();
    }
}
