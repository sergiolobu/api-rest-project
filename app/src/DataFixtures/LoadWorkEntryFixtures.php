<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\WorkEntry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadWorkEntryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('test work');
        $user->setEmail('test+work@gmail.com');
        $manager->persist($user);
        $manager->flush();


        $today = new \DateTime('now');
        $yesterday = new \DateTime('yesterday');

        $workEntry = new WorkEntry();
        $workEntry->setUser($user);
        $workEntry->setStartDate($yesterday);
        $workEntry->setEndDate($today);
        $manager->persist($workEntry);
        $manager->flush();
    }
}
