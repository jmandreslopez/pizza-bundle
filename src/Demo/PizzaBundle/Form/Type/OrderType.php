<?php

namespace Demo\PizzaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderType extends AbstractType
{
    private $sizes;

    public function __construct($sizes)
    {
        $this->sizes = $sizes;
    }

    /**
     * Build form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredient1', 'checkbox', array(
                'label'    => 'Ingredient 1',
                'required' => false,
            ))
            ->add('ingredient2', 'checkbox', array(
                'label'    => 'Ingredient 2',
                'required' => false,
            ))
            ->add('ingredient3', 'checkbox', array(
                'label'    => 'Ingredient 3',
                'required' => false,
            ))
            ->add('sizeId', 'choice', array(
                'label'    => 'Size',
                'choices'  => $this->sizes
            ))
            ->add('submit', 'submit', array(
                'label'    => 'Submit',
                'attr'     => array('class' => 'save'),
            ));
    }

    /**
     * Get the forms name
     *
     * @return string name
     */
    public function getName()
    {
        return 'order';
    }
}
