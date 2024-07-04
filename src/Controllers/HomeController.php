<?php

namespace Run\Controllers;

use Run\Response;
use Twig\Environment;

class HomeController
{
    // Protected property to store the Twig environment instance
    protected $twig;

    // Constructor is called when an instance of the controller is created
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Handles the index action for the HomeController.
     */
    public function index()
    {
        $content = $this->twig->render('home/index.twig', [
            'title' => 'Home'
        ]);

        return (new Response())->setHttpStatus(200)
            ->setContents($content)
            ->setHeader('Content-Type', 'text/html');
    }
}