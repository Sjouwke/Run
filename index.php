<?php

require __DIR__ . '/src/Router.php';
require __DIR__ . '/src/Resoponse.php';
require __DIR__ . '/src/Controllers/BlogController.php';
require __DIR__ . '/src/Controllers/HomeController.php';
require __DIR__ . '/src/Controllers/ProductController.php';

use Run\src\Router;
use Run\src\Response;
use Run\src\Controllers\HomeController;
use Run\src\Controllers\BlogController;
use Run\src\Controllers\ProductController;

// The Router class DOES NOT take any arguments to be initialized
$router = new Router();

// The get() method MUST take as a first argument a path and as the second argument a callable (function)
$router->get('/', [HomeController::class, 'index']);
$router->get('blog/', [BlogController::class, 'index']);
$router->get('producten/', [ProductController::class, 'index']);
$router->get('producten/bekijk/', function() {
    return (new Response())->setHttpStatus(200)
        ->setContents('Dit is een product view response dink!')
        ->setHeader('Content-Type', 'text/plain')
        ->emit();
});

// The route() method SHOULD print the output of the registered function for the given path
$router->route('producten/bekijk/');