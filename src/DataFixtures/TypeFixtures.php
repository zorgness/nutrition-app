<?php

namespace App\DataFixtures;

use App\Entity\Food;
use App\Entity\Type;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $t1 = new Type();
        $t1->setLabel('fruits')
            ->setImage('fruit.jpg');
        $manager->persist($t1);

        $t2 = new Type();
        $t2->setLabel('vegetables')
            ->setImage('vegetable.png');
        $manager->persist($t2);


        $foodRepository = $manager->getRepository(Food::class);

        $a1 = $foodRepository->findOneBy(['name' => 'carrot']);
        $a1->setType($t1);
        $manager->persist($a1);
        $a2 = $foodRepository->findOneBy(['name' => 'apple']);
        $a2->setType($t1);
        $manager->persist($a2);
        $a3 = $foodRepository->findOneBy(['name' => 'tomatoe']);
        $a3->setType($t1);
        $manager->persist($a3);
        $a4 = $foodRepository->findOneBy(['name' => 'potatoe']);
        $a4->setType($t2);
        $manager->persist($a4);


        $manager->flush();
    }
}
