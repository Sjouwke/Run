<?php

namespace Run\Controllers;

class HomeController extends Controller
{
    /**
     * Handles the index action for the HomeController.
     */
    public function index()
    {
        return $this->render('pages/home/index.twig', [
            'page' => 'Home',
            'title' => 'Hallokes, welkom op Home'
        ]);
    }
}