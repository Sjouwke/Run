<?php

namespace Run\Controllers;

class HomeController extends Controller
{
    /**
     * Handles the index action for the HomeController.
     */
    public function index()
    {
        $input = $this->request->getInput();

        return $this->render('pages/home/index.twig', array_merge($input, [
            'page' => 'Home',
            'title' => 'Home',
        ]));
    }
}