<?php

namespace Demo\PizzaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CustomerNewType extends AbstractType
{
    /**
     * Build form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text', array(
                'label' => 'First Name'
            ))
            ->add('lastname', 'text', array(
                'label' => 'Last Name'
            ))
            ->add('phone', 'text', array(
                'label' => 'Phone Number'
            ))
            ->add('address', 'text', array(
                'label' => 'Address'
            ))
            ->add('submit', 'submit', array(
                'label' => 'Submit',
                'attr'  => array('class' => 'save'),
            ));
    }

    /**
     * Get the forms name
     *
     * @return string name
     */
    public function getName()
    {
        return 'new_customer';
    }
}
