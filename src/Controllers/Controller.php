<?php

namespace Run\Controllers;

use Run\Request;
use Run\Response;
use Twig\Environment;

class Controller
{
    // Protected property to store the Twig environment instance
    protected $twig;

    // Protected property to store the passed request
    protected $request;

    // Constructor is called when an instance of the controller is created
    public function __construct(Environment $twig, Request $request)
    {
        $this->twig = $twig;
        $this->request = $request;
    }

    /**
     * Render the given data in the passed template
     *
     * @param $template
     * @param $data
     */
    protected function render(string $template, array $data = []): string
    {
        return $this->twig->render($template, $data);
    }
}