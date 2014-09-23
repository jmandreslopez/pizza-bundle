<?php

namespace Demo\PizzaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Demo\PizzaBundle\Form\Type\CustomerSearchType;
use Demo\PizzaBundle\Entity\Customers;

class OrderControllerTest extends WebTestCase
{
    /**
     * Test OrderController::indexAction
     */
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/order');
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('#order-step1')->count() > 0);
    }

    /**
     * Test OrderController::step1Action
     */
    public function testStep1()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/order/step1');
        $this->assertTrue($crawler->filter('#order-step1')->count() > 0);
    }

    /**
     * Test OrderController::step2Action
     * with no parameters
     */
    public function testStep2()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/order/step2');
        $this->assertFalse($crawler->filter('#order-step2')->count() > 0);
    }

    /**
     * Test OrderController::step2Action
     * checking for error page
     */
    public function testStep2Error()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/order/step2');
        $this->assertTrue($crawler->filter('#error')->count() > 0);
    }

    /**
     * Test OrderController::step2Action
     * with Id parameter
     */
    public function testStep2WithId()
    {
        $client = static::createClient();

        // Get one Customer Id
        $customerId = $client->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository('DemoPizzaBundle:Customers')
            ->getOne();

        if (!empty($customerId)) {
            $crawler = $client->request('GET', '/order/step2?id=1');
            $this->assertTrue($crawler->filter('#order-step2')->count() > 0);
        }
    }

    /**
     * Test OrderController::step3Action
     */
    public function testStep3()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/order/step3');
        $this->assertTrue($crawler->filter('#order-step3')->count() > 0);
    }

    /**
     * Create Order
     */
    public function testOrder()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/order/step1');
        $this->assertTrue($crawler->filter('#order-step1')->count() > 0);

        // Search Customer Form Data
        $formData = array(
            'search_customer[phone]' => '(111) 222-3333'
        );

        // Search Customer Form
        $form = $crawler->selectButton('search_customer_submit')->form();
        $form->setValues($formData);

        // Submit Form
        $client->submit($form);

        // Follow Redirects
        $crawler = $client->followRedirect();

        if ($crawler->filter('#order-step2')->count() > 0) {
            $this->assertTrue($crawler->filter('#order-step2')->count() > 0);

            // Test OrderStep2
            $this->_testStep2($client, $crawler);
        } else {
            $this->assertTrue($crawler->filter('#register')->count() > 0);

            // Test Register
            $this->_testRegister($client, $crawler);
        }
    }

    /**
     * Test Order Step2
     *
     * @called
     * - self::testOrder
     * - self::_testRegister
     * @param object $client
     * @param object $crawler
     */
    private function _testStep2($client, $crawler)
    {
        // Order Form Data
        $formData = array(
            'order[ingredient1]' => 1,
            'order[ingredient2]' => 1,
            'order[ingredient3]' => 1,
            'order[sizeId]'      => 1
        );

        // Order Form
        $form = $crawler->selectButton('order_submit')->form();
        $form->setValues($formData);

        // Submit Form
        $client->submit($form);

        // Follow Redirects
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('#order-step3')->count() > 0);
    }

    /**
     * Test Register
     *
     * @called
     * - self::testOrder
     * @param object $client
     * @param object $crawler
     */
    private function _testRegister($client, $crawler)
    {
        // Register Customer Form Data
        $formData = array(
            'new_customer[firstname]' => 'Firstname',
            'new_customer[lastname]'  => 'Lastname',
            'new_customer[phone]'     => '(111) 222-3333',
            'new_customer[address]'   => 'Address'
        );

        // Register Customer Form
        $form = $crawler->selectButton('new_customer_submit')->form();
        $form->setValues($formData);

        // Submit Form
        $client->submit($form);

        // Follow Redirects
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('#order-step2')->count() > 0);

        // Test OrderStep2
        $this->_testStep2($client, $crawler);
    }
}