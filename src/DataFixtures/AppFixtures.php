<?php

namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $a1 = new Food();
        $a1->setName('carrot')
          ->setPrice(0.40)
          ->setImage('food/carrot.png')
          ->setCalorie(36)
          ->setProtein(0.77)
          ->setCarbohydrates(6.45)
          ->setLipids(0.26);
        $manager->persist($a1);

        $a2 = new Food();
        $a2->setName('apple')
          ->setPrice(0.30)
          ->setImage('food/apple.png')
          ->setCalorie(38)
          ->setProtein(0.81)
          ->setCarbohydrates(6.27)
          ->setLipids(0.23);
        $manager->persist($a2);

        $a3 = new Food();
        $a3->setName('potatoe')
          ->setPrice(0.30)
          ->setImage('food/potatoe.png')
          ->setCalorie(45)
          ->setProtein(0.9)
          ->setCarbohydrates(7.3)
          ->setLipids(0.34);
        $manager->persist($a3);

        $a4 = new Food();
        $a4->setName('tomatoe')
          ->setPrice(0.26)
          ->setImage('food/tomatoe.png')
          ->setCalorie(34)
          ->setProtein(0.8)
          ->setCarbohydrates(5.2)
          ->setLipids(0.27);
        $manager->persist($a4);

        $manager->flush();
    }
}