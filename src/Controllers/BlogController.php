<?php

namespace Run\Controllers;

use Run\Response;

class BlogController extends Controller
{
    /**
     * Handles the index action for the BlogController.
     */
    public function index()
    {
        return $this->render('pages/blog/index.twig', [
            'page' => 'Blog'
        ]);
    }
}