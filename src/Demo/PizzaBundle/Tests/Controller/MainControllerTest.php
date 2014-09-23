<?php

namespace Demo\PizzaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    /**
     * Test MainController::indexAction
     */
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($crawler->filter('#carousel')->count() > 0);
    }

    /**
     * Test MainController::aboutAction
     */
    public function testAbout()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/about');
        $this->assertTrue($crawler->filter('.page-header')->count() > 0);
    }
}