<?php

namespace Demo\PizzaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * Home
     *
     * @return render
     */
    public function indexAction()
    {
        // Render Home
        return $this->render('DemoPizzaBundle:Main:index.html.twig');
    }

    /**
     * About
     *
     * @return render
     */
    public function aboutAction()
    {
        // Render About
        return $this->render('DemoPizzaBundle:Main:about.html.twig');
    }
}