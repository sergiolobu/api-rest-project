<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setName('test');
         $user->setEmail('test+1234@gmail.com');

         $manager->persist($user);

        $userToUpdate = new User();
        $userToUpdate->setName('test for update');
        $userToUpdate->setEmail('test+update@gmail.com');

        $manager->persist($userToUpdate);

        $manager->flush();
    }
}
