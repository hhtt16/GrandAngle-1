<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setLastname('Rabier');
        $user->setFirstname('Jérôme');
        $user->setEmail('jrmrabier@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('$2y$13$Sh7Cb4femd8hz1SH3ysVoOw9y/KzF.4sszhK8QBZglV9TLRs8gddS');
        $user->setAddress('4 allée de la prairie');
        $user->setPostalCode('41700');
        $user->setCity('Sassay');
        $user->setBirthDate(date_create('1986-01-27'));
        $user->setHireDate(date_create('now'));
        $user->setCreatedAt(date_create('now'));
        $manager->persist($user);

        $user = new User();
        $user->setLastname('Chaussadas');
        $user->setFirstname('Nicolas');
        $user->setEmail('nicolaschaussadas@outlook.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('$2y$10$fcnLeE7orWVNn/cqn3brT.XJPJWounxf4twzm/HvsDeDIwk1DwLsu');
        $user->setAddress('4 Avenue de Paris');
        $user->setPostalCode('45000');
        $user->setCity('Orléans');
        $user->setBirthDate(date_create('1995-01-01'));
        $user->setHireDate(date_create('now'));
        $user->setCreatedAt(date_create('now'));
        $manager->persist($user);

        $manager->flush();
    }
}
