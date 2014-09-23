<?php

namespace Demo\PizzaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * Admin
     */
    public function indexAction(Request $request)
    {
        // Knp Paginator
        $knpPaginator = $this->get('knp_paginator');

        // Query
        $query = $this->getDoctrine()
            ->getRepository('DemoPizzaBundle:Orders')
            ->getPaginationQuery();

        // Pagination
        $pagination = $knpPaginator->paginate($query,
            $request->query->get('page', 1),
            10 /* Limit per page */
        );

        // Render Admin
        return $this->render('DemoPizzaBundle:Admin:index.html.twig', array(
            'pagination' => $pagination
        ));
    }
}

