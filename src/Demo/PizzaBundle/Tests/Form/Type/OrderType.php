<?php

namespace Demo\PizzaBundle\Tests\Form\Type;

use Demo\PizzaBundle\Form\Type\OrderType;
use Demo\PizzaBundle\Entity\Orders;
use Symfony\Component\Form\Test\TypeTestCase;

class OrderTypeTest extends TypeTestCase
{
    /**
     * Test Submit of OrderType Form
     */
    public function testSubmit()
    {
        $formData = array(
            'ingredient1' => 'ingredient1',
            'ingredient2' => 'ingredient2',
            'ingredient3' => 'ingredient3',
            'sizeId'      => 'sizeId'
        );

        // Tested Object
        $object = new Orders();
        $object->setIngredient1($formData['ingredient1']);
        $object->setIngredient2($formData['ingredient1']);
        $object->setIngredient3($formData['ingredient1']);
        $object->setSizeId($formData['sizeId']);

        // Tested Type
        $type = new OrderType();
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

