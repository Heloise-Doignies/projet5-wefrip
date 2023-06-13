<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    //Pour hacher le mot de passe : sécurité
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@user.com');
        $user->setUserSlug('user-user');
        $user->setPassword($this->encoder->hashPassword($user, 'password'));
        //$user->setRoles(['ROLE_USER']);
        $user->setIsVerified(true);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('admin@wefrip.com');
        $user->setUserSlug('admin-admin');
        $user->setPassword($this->encoder->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setIsVerified(true);
        $manager->persist($user);

        $manager->flush();
    }
}
