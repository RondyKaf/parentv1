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
        $pin->setTitle("Consultation Malade");
        $pin->setDescription("tu souffres d'une maladie grave");

        $manager->persist($pin);


        $pin1 = new Pins();
        $pin1->setTitle("Consultation Epidemie");
        $pin1->setDescription("tu souffres d'une épidemie qui ");

        $manager->persist($pin1);
        $manager->flush();
    }
}