<?php

namespace Run\Controllers;

use Run\Container;
use Run\Request;

class BlogController
{
    /**
     * Handles the index action for the BlogController.
     *
     * @param Request $request
     */
    public static function index(Request $request): string
    {
        $input = $request->getInput();

        $twig = Container::make('view');

        return $twig->render('pages/blog/index.twig', [
            'page' => 'Blog'
        ]);
    }
}