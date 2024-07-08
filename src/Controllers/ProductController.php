<?php

namespace Run\Controllers;

class ProductController extends Controller
{
    /**
     * Handles the index action for the ProductController.
     */
    public function index()
    {
       return $this->render('pages/product/index.twig', [
            'page' => 'Product'
        ]);
    }
}