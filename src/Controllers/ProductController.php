<?php

namespace Run\Controllers;

class ProductController extends Controller
{
    /**
     * Handles the index action for the ProductController.
     */
    public function index()
    {
        $input = $this->request->getInput();

        return $this->render('pages/product/index.twig', array_merge($input, [
            'page' => 'Product',
        ]));
    }
}