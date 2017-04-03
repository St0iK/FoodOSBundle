<?php

namespace St0iK\FoodosBundle\DataFixtures\ORM;

use St0iK\FoodosBundle\Entity\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Defines the sample users to load in the database before running the unit and
 * functional tests. Execute this command to load the data.
 *
 *   $ php bin/console doctrine:fixtures:load
 *
 */
class ProductFixtures extends AbstractFixture implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        $classicProduct = new Product();
        $classicProduct->setTitle("CLASSIC");
        $classicProduct->setDescription("Our original HBC burger relish, mayo, lettuce, tomato & red onion");
        $classicProduct->setWeight(1);
        $classicProduct->setPrice(10);
        $classicProduct->addCategory($this->getReference('burger-category'));
        $this->addReference('classic-burger', $classicProduct);
        $manager->persist($classicProduct);

        $cheeseProduct = new Product();
        $cheeseProduct->setTitle("CHEESE CLASSIC");
        $cheeseProduct->setDescription("With a choice of either; Mature cheddar, American cheese, Red Leicester or Applewood smoked cheddar. Served with our original HBC burger relish, mayo, lettuce, tomato & red onion");
        $cheeseProduct->setWeight(1);
        $cheeseProduct->setPrice(12);
        $cheeseProduct->addCategory($this->getReference('burger-category'));
        $this->addReference('cheese-burger', $cheeseProduct);
        $manager->persist($cheeseProduct);

        $baconProduct = new Product();
        $baconProduct->setTitle("PEANUT BUTTER AND BACON");
        $baconProduct->setDescription("Peanut butter, smoked bacon, chilli jam, lettuce, tomato & red onion");
        $baconProduct->setWeight(1);
        $baconProduct->setPrice(13);
        $baconProduct->addCategory($this->getReference('burger-category'));
        $this->addReference('peanut-burger', $baconProduct);
        $manager->persist($baconProduct);

        $manager->flush();
    }
}
