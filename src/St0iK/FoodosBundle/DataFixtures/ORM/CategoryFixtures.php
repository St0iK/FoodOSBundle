<?php

namespace St0iK\FoodosBundle\DataFixtures\ORM;

use St0iK\FoodosBundle\Entity\Category;
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
class CategoryFixtures extends AbstractFixture implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        $burgerCategory = new Category();
        $burgerCategory->setTitle("Burgers");
        $burgerCategory->setDescription("Lorem Ipsum for the burgers");
        $burgerCategory->setWeight(1);
        $manager->persist($burgerCategory);
        $this->addReference('burger-category', $burgerCategory);


        $saladCategory = new Category();
        $saladCategory->setTitle("Salads");
        $saladCategory->setDescription("Lorem Ipsum Salads and some extra text");
        $saladCategory->setWeight(2);
        $manager->persist($saladCategory);
        $this->addReference('salad-category', $saladCategory);

        $drinksCategory = new Category();
        $drinksCategory->setTitle("Drinks");
        $drinksCategory->setDescription("Lorem Ipsum Drinks and some extra text");
        $drinksCategory->setWeight(3);
        $manager->persist($drinksCategory);
        $this->addReference('drinks-category', $drinksCategory);

        $manager->flush();
    }
}
