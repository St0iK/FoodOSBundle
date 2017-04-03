<?php

namespace St0iK\FoodosBundle\DataFixtures\ORM;

use St0iK\FoodosBundle\Entity\Ingredient;
use St0iK\FoodosBundle\Entity\ProductIngredients;
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
//$this->addReference('classic-burger', $classicProduct);
//$this->addReference('cheese-burger', $classicProduct);
//$this->addReference('peanut-burger', $classicProduct);
class ProductIngredientsFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $productIngredient_1 = new ProductIngredients();
        $productIngredient_1->setProduct($this->getReference('classic-burger'));
        $productIngredient_1->setIngredient($this->getReference('ingredient-1'));
        $productIngredient_1->setPrice(1);
        $manager->persist($productIngredient_1);

        $productIngredient_2 = new ProductIngredients();
        $productIngredient_2->setProduct($this->getReference('cheese-burger'));
        $productIngredient_2->setIngredient($this->getReference('ingredient-2'));
        $productIngredient_2->setPrice(2);
        $manager->persist($productIngredient_2);

        $productIngredient_3 = new ProductIngredients();
        $productIngredient_3->setProduct($this->getReference('peanut-burger'));
        $productIngredient_3->setIngredient($this->getReference('ingredient-3'));
        $productIngredient_3->setPrice(3);
        $manager->persist($productIngredient_3);
        $manager->flush();
    }
}
