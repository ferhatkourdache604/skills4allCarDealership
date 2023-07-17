<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Factory\CarFactory;
use App\Factory\CategoryFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CarFactory::createMany(60);
        CategoryFactory::createMany(6);
    }
}
