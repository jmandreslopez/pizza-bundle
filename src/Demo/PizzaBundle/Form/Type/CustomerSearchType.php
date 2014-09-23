<?php

namespace Demo\PizzaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CustomerSearchType extends AbstractType
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
            ->add('phone', 'text')
            ->add('submit', 'submit', array(
                'label'    => 'Search',
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
        return 'search_customer';
    }
}
