<?php

namespace Run\Controllers;

use Run\Container;
use Run\Request;

class HomeController
{
    /**
     * Handles the index action for the HomeController.
     *
     * @param Request $request
     */
    public static function index(Request $request): string
    {
        $input = $request->getInput();
        $category = $input['category'] ?? null;
        $twig = Container::make('view');

        return $twig->render('pages/home/index.twig', [
            'page' => 'Home',
            'title' => 'Home',
            'category' => $category
        ]);
    }
}