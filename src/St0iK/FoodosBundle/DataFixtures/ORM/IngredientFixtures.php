<?php

namespace St0iK\FoodosBundle\DataFixtures\ORM;

use St0iK\FoodosBundle\Entity\Ingredient;
use St0iK\FoodosBundle\Entity\User;
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
class IngredientFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $ingredient_1 = new Ingredient();
        $ingredient_1->setTitle('Ingredient 1');
        $ingredient_1->setDescription('Lorem ipsum and some other stuff for the description');
        $manager->persist($ingredient_1);
        $this->addReference('ingredient-1', $ingredient_1);

        $ingredient_2 = new Ingredient();
        $ingredient_2->setTitle('Ingredient 2');
        $ingredient_2->setDescription('Lorem ipsum and some other stuff for the description 2');
        $manager->persist($ingredient_2);
        $this->addReference('ingredient-2', $ingredient_2);


        $ingredient_3 = new Ingredient();
        $ingredient_3->setTitle('Ingredient 3');
        $ingredient_3->setDescription('Lorem ipsum and some other stuff for the description 3');
        $manager->persist($ingredient_3);
        $this->addReference('ingredient-3', $ingredient_3);
        $manager->flush();
    }
}
