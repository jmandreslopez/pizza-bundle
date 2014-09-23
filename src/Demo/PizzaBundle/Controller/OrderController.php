<?php

namespace Demo\PizzaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Demo\PizzaBundle\Entity\Customers;
use Demo\PizzaBundle\Entity\Orders;
use Demo\PizzaBundle\Form\Type\CustomerSearchType;
use Demo\PizzaBundle\Form\Type\OrderType;

class OrderController extends Controller
{
    /**
     * Order
     *
     * @return render
     */
    public function indexAction()
    {
        // Redirect to Step1
        return $this->redirect($this->generateUrl('order-step1'));
    }

    /**
     * Order :: Step1
     *
     * @param Request $request
     * @return render
     */
    public function step1Action(Request $request)
    {
        // Search Customer
        $searchCustomer = new Customers();
        $searchCustomer->setFirstname('N/A');
        $searchCustomer->setLastname('N/A');
        $searchCustomer->setAddress('N/A');

        // Generate Form
        $formCustomer = $this->createForm(new CustomerSearchType(), $searchCustomer);

        // Bind Form to Request
        $formCustomer->handleRequest($request);

        // Check if it's valid
        if ($formCustomer->isValid())
        {
            // Request Customer
            $requestCustomer = $formCustomer->getData();

            // Check for Customer on DB
            // If exists, grabs the Customer Object
            $customer = $this->getDoctrine()
                ->getRepository('DemoPizzaBundle:Customers')
                    ->findOneBy(array(
                        'phone' => $requestCustomer->getPhone()
                    ));

            if (!empty($customer)) {
                // Redirect to Step2 sending Customer Id
                return $this->redirect($this->generateUrl('order-step2', array(
                    'id' => $customer->getId()
                )));
            } else {
                // Redirect to create new Customer
                // sending Customer Phone
                return $this->redirect($this->generateUrl('register', array(
                    'phone' => $requestCustomer->getPhone()
                )));
            }
        }

        // Render Step1
        return $this->render('DemoPizzaBundle:Order:step1.html.twig', array(
            'form' => $formCustomer->createView()
        ));
    }

    /**
     * Order :: Step2
     *
     * @param Request $request
     * @return render
     */
    public function step2Action(Request $request)
    {
        // Request Customer Id
        $requestId = $request->query->get('id');

        if (!empty($requestId)) {

            // Customer Object
            $customer = $this->getDoctrine()
                ->getRepository('DemoPizzaBundle:Customers')
                ->find($requestId);

            // Get Sizes Array
            // for Choices Input
            $sizes = $this->getDoctrine()
                ->getRepository('DemoPizzaBundle:Sizes')
                ->getChoices();

            if (!empty($customer) && !empty($sizes)) {

                // New Order Object
                $order = new Orders();
                $order->setCustomerId($customer->getId());
                $order->setDelivered(false);

                // Generate Form
                $formOrder = $this->createForm(new OrderType($sizes), $order);

                // Bind Form to Request
                $formOrder->handleRequest($request);

                // Check if it's valid
                if ($formOrder->isValid())
                {
                    // Request Order
                    $requestOrder = $formOrder->getData();

                    // Get Size Object for Size Id
                    $size = $this->getDoctrine()
                        ->getRepository('DemoPizzaBundle:Sizes')
                        ->find($requestOrder->getSizeId());

                    if (!empty($size)) {

                        // Link Foreign Objects
                        // to Request Order
                        $requestOrder->setCustomer($customer);
                        $requestOrder->setSize($size);

                        // Doctrine Manager
                        $manager = $this->getDoctrine()->getManager();

                        // Save to DB
                        $manager->persist($order);
                        $manager->flush();

                        // Free Memory
                        $manager->detach($order);
                        $manager->clear();

                        // Redirect to Step3
                        return $this->redirect($this->generateUrl('order-step3'));
                    } else {
                        // ERROR
                        return $this->render('DemoPizzaBundle::error.html.twig');
                    }
                }

                // Render Step2
                return $this->render('DemoPizzaBundle:Order:step2.html.twig', array(
                    'form' => $formOrder->createView(),
                    'firstname' => $customer->getFirstname(),
                ));
            } else {
                // ERROR
                return $this->render('DemoPizzaBundle::error.html.twig');
            }
        } else {
            // ERROR
            return $this->render('DemoPizzaBundle::error.html.twig');
        }
    }

    /**
     * Order :: Step3
     *
     * @return render
     */
    public function step3Action()
    {
        // Render Step3
        return $this->render('DemoPizzaBundle:Order:step3.html.twig');
    }
}