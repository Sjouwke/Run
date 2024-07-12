<?php

namespace Run\Controllers;

class BlogController extends Controller
{
    /**
     * Handles the index action for the BlogController.
     */
    public function index()
    {
        $input = $this->request->getInput();

        return $this->render('pages/blog/index.twig', $input);
    }
}