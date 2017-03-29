<?php

namespace St0iK\FoodosBundle\Tests\Admin\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/backend/login');

        $this->assertContains('Login Form', $client->getResponse()->getContent());
    }
}
