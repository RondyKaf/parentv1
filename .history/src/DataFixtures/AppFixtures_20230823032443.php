<?php

namespace App\DataFixtures;

use App\Entity\Pins;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $pin = new Pins();
        $pin->se
        $manager->flush();
    }
}
