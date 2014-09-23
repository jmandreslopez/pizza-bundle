<?php

namespace Demo\PizzaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    /**
     * Test AdminController::indexAction
     */
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin');
        $this->assertTrue($crawler->filter('html:contains("Admin")')->count() > 0);
    }
}