<?php

namespace Demo\PizzaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    /**
     * Test RegisterController::indexAction
     */
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $this->assertFalse($crawler->filter('#register')->count() > 0);
    }

    /**
     * Test RegisterController::indexAction
     * checking for error page
     */
    public function testIndexError()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $this->assertTrue($crawler->filter('#error')->count() > 0);
    }

    /**
     * Test RegisterController::indexAction
     * with parameters
     */
    public function testIndexWithParameters()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register?phone=%28123%29+124-2353');
        $this->assertTrue($crawler->filter('#register')->count() > 0);
    }

    /**
     * Test RegisterController::indexAction
     * with parameters and spaces
     */
    public function testIndexWithParametersAndSpaces()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register?phone=(281) 124-2353');
        $this->assertTrue($crawler->filter('#register')->count() > 0);
    }

    /**
     * Test RegisterController::indexAction
     * with wrong parameters
     */
    public function testIndexWithWrongParameters()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register?phone=(281)');
        $this->assertFalse($crawler->filter('#register')->count() > 0);

        $crawler = $client->request('GET', '/register?phone=test');
        $this->assertFalse($crawler->filter('#register')->count() > 0);
    }
}