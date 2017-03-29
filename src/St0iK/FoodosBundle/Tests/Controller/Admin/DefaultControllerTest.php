<?php

namespace St0iK\FoodosBundle\Tests\Admin\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use St0iK\FoodosBundle\Entity\Category;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Response;
use Faker;

class DefaultControllerTest extends WebTestCase
{
    private $client = null;
    /**
     * @var Faker $faker
     */
    private $faker = null;

    public function setUp()
    {
        $this->client = static::createClient([], [
            'PHP_AUTH_USER' => 'stoik_admin',
            'PHP_AUTH_PW' => '123123123',
        ]);

        $this->faker = Faker\Factory::create();
    }

    public function testItContainsManageCatalog()
    {
        $this->client->request('GET', '/backend/catalog');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Manage Catalog', $this->client->getResponse()->getContent());
    }

    public function testItContainsAddNewCategoryLink()
    {
        $this->client->request('GET', '/backend/catalog');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Category', $this->client->getResponse()->getContent());
    }

    /**
     * Test Creating a New Category
     */
    public function testAddNewCategoryAjaxRequest()
    {
        $title = $this->getRandomTitle();
        $weight = $this->getRandomInteger();
        $description = $this->getRandomDescription();

        $this->client->request('POST', '/backend/catalog/ajaxCategoryAdd',
            array(
                'st0ik_foodosbundle_category' => array(
                    'title' => $title,
                    'weight' => $weight,
                    'description' => $description
                ),
            ),
            array(),
            array(
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            ));
        //  Assert Response Code
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $category = $this->client->getContainer()->get('doctrine')->getRepository(Category::class)->findOneBy([
            'title' => $title,
        ]);

        // Assert entry Exists
        $this->assertNotNull($category);

        // Assert entry data
        $this->assertSame($title, $category->getTitle());
        $this->assertSame($weight, $category->getWeight());

    }

    /**
     * Tests that Update Category ajax call works
     * It grabs the last inserted category
     * and updates all its fields and then asserts that
     * it was really updated
     */
    public function testEditCategoryAjax()
    {
        $title = $this->getRandomTitle();
        $weight = $this->getRandomInteger();
        $description = $this->getRandomDescription();
        $category = $this->client->getContainer()->get('doctrine')->getRepository(Category::class)->getLastEntity();

        $this->client->request('POST', '/backend/catalog/ajaxCategoryEdit/' . $category->getId(),
            array(
                'st0ik_foodosbundle_category' => array(
                    'title' => $title,
                    'weight' => $weight,
                    'description' => $description
                ),
            ),
            array(),
            array(
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            ));
        //  Assert Response Code
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $category = $this->client->getContainer()->get('doctrine')->getRepository(Category::class)->findOneBy([
            'title' => $title,
        ]);

        // Assert entry Exists
        $this->assertNotNull($category);

        // Assert entry data
        $this->assertSame($title, $category->getTitle());
        $this->assertSame($weight, $category->getWeight());
    }
    /**
     * Generates a random Sentence using Faker
     * @return mixed
     */
    private function getRandomTitle()
    {
        return $this->faker->sentence();
    }

    /**
     * Generates a random integer that is not null
     * using Faker
     * @return mixed
     */
    private function getRandomInteger()
    {
        return $this->faker->randomDigitNotNull();
    }

    /**
     * Generates a random text using Faker
     * @return mixed
     */
    private function getRandomDescription()
    {
        return $this->faker->text();
    }
}
