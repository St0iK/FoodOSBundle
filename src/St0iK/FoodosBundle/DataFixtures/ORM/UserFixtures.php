<?php

namespace AppBundle\DataFixtures\ORM;

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
class UserFixtures extends AbstractFixture implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $stoikAdmin = new User();
        $stoikAdmin->setUsername('stoik_admin');
        $stoikAdmin->setEmail('jstoikidis+symfony@gmail.com');
        $stoikAdmin->setRoles(['ROLE_ADMIN']);
        $stoikAdmin->setEnabled(true);
        $encodedPassword = $passwordEncoder->encodePassword($stoikAdmin, '123123123');
        $stoikAdmin->setPassword($encodedPassword);
        $manager->persist($stoikAdmin);
        // In case if fixture objects have relations to other fixtures, adds a reference
        // to that object by name and later reference it to form a relation.
        // See https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html#sharing-objects-between-fixtures
        $this->addReference('admin-user', $stoikAdmin);

        $simpleUser = new User();
        $simpleUser->setUsername('jim_user');
        $simpleUser->setEmail('jstoikidis+simple@gmail.com');
        $simpleUser->setEnabled(true);
        $encodedPassword = $passwordEncoder->encodePassword($simpleUser, '123123123');
        $simpleUser->setPassword($encodedPassword);
        $manager->persist($simpleUser);
        $this->addReference('simple-user', $simpleUser);

        $manager->flush();
    }
}
