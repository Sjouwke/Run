<?php

namespace Run\Controllers;

use Twig\Environment;

class Controller
{
    // Protected property to store the Twig environment instance
    protected $twig;

    // Constructor is called when an instance of the controller is created
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
}