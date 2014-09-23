<?php

namespace Demo\PizzaBundle\Tests\Form\Type;

use Demo\PizzaBundle\Form\Type\CustomerSearchType;
use Demo\PizzaBundle\Entity\Customers;
use Symfony\Component\Form\Test\TypeTestCase;

class CustomerSearchTypeTest extends TypeTestCase
{
    /**
     * Test Submit of CustomerSearchType Form
     */
    public function testSubmit()
    {
        $formData = array(
            'phone' => 'phone'
        );

        // Tested Object
        $object = new Customers();
        $object->setPhone($formData['phone']);

        // Tested Type
        $type = new CustomerSearchType();
        $form = $this->factory->create($type, $object);

        // Submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key)
        {
            $this->assertArrayHasKey($key, $children);
        }
    }
}