<?php

namespace Demo\PizzaBundle\Tests\Form\Type;

use Demo\PizzaBundle\Form\Type\CustomerNewType;
use Demo\PizzaBundle\Entity\Customers;
use Symfony\Component\Form\Test\TypeTestCase;

class CustomerNewTypeTest extends TypeTestCase
{
    /**
     * Test Submit of CustomerNewType Form
     */
    public function testSubmit()
    {
        $formData = array(
            'firstname' => 'firstname',
            'lastname'  => 'lastname',
            'phone'     => 'phone',
            'address'   => 'address'
        );

        // Tested Object
        $object = new Customers();
        $object->setFirstname($formData['firstname']);
        $object->setLastname($formData['lastname']);
        $object->setPhone($formData['phone']);
        $object->setAddress($formData['address']);

        // Tested Type
        $type = new CustomerNewType();
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