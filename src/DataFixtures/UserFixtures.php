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
        $user->setPseudo('User Toto');
        $user->setPassword($this->encoder->hashPassword($user, 'password'));
        $user->setRoles(['ROLE_USER']);
        // $user->setAvatarName('toto.jpg');
        $user->setIsVerified(true);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('admin@wefrip.com');
        $user->setUserSlug('admin-admin');
        $user->setPseudo('Admin Titi');
        $user->setPassword($this->encoder->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        // $user->setAvatarName('admin.jpg');
        $user->setIsVerified(true);
        $manager->persist($user);

        $manager->flush();
    }
}
