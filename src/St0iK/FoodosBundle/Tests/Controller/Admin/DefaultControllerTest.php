<?php

namespace St0iK\FoodosBundle\Tests\Admin\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $classes = array(
            'St0iK\FoodosBundle\DataFixtures\ORM\CategoryFixtures',
            'St0iK\FoodosBundle\DataFixtures\ORM\ProductFixtures',
            'St0iK\FoodosBundle\DataFixtures\ORM\UserFixtures',
        );
        //$this->loadFixtures($classes);

        $this->client = static::createClient();
    }

    public function testBackend()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'stoik_admin',
            'PHP_AUTH_PW' => '123123123',
        ]);
        $client->request('GET', '/backend');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertContains('Catalog', $client->getResponse()->getContent());
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        // the firewall context (defaults to the firewall name)
        $firewall = 'admin_secured_area';

        $token = new UsernamePasswordToken('admin', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
