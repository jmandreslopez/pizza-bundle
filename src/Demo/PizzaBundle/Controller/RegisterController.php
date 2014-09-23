<?php

namespace Demo\PizzaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Demo\PizzaBundle\Entity\Customers;
use Demo\PizzaBundle\Form\Type\CustomerNewType;

class RegisterController extends Controller
{
    private $_phoneRegex = '/^(\((\d{3})\)|(\d{3}))\s*[-\/\.]?\s*(\d{3})\s*[-\/\.]?\s*(\d{4})\s*(([xX]|[eE][xX][tT])\.?\s*(\d+))*$/';

    /**
     * Register new Customer
     *
     * @return render
     */
    public function indexAction(Request $request)
    {
        // Request Customer Phone
        $requestPhone = $request->query->get('phone');

        if (!empty($requestPhone) && preg_match($this->_phoneRegex, $requestPhone))
        {
            // New Customer Object
            $customer = new Customers();
            $customer->setPhone($requestPhone);

            // Generate Form
            $form = $this->createForm(new CustomerNewType(), $customer);

            // Bind Form to Request
            $form->handleRequest($request);

            // Check if it's valid
            if ($form->isValid())
            {
                // Doctrine Manager
                $manager = $this->getDoctrine()->getManager();

                // Save to DB
                $manager->persist($customer);
                $manager->flush();

                // Customer Id
                $customerId = $customer->getId();

                // Free Memory
                $manager->detach($customer);
                $manager->clear();

                // Redirect to Order::Step2
                // Sending Customer Id
                return $this->redirect($this->generateUrl('order-step2', array(
                    'id' => $customerId
                )));
            }

            // Render Register
            return $this->render('DemoPizzaBundle:Register:index.html.twig', array(
                'form' => $form->createView()
            ));
        }

        // ERROR
        return $this->render('DemoPizzaBundle::error.html.twig');
    }
}

