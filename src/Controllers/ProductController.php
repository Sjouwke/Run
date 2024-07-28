<?php

namespace Run\Controllers;

use Run\Container;
use Run\Request;

class ProductController
{
    /**
     * Handles the index action for the ProductController.
     *
     * @param Request $request
     */
    public static function index(Request $request): string
    {
        $input = $request->getInput();

        $twig = Container::make('view');

        return $twig->render('pages/product/index.twig', [
            'page' => 'Product',
        ]);
    }
}