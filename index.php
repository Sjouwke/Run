<?php

require __DIR__ . '/src/Router.php';
require __DIR__ . '/src/Response.php';
require __DIR__ . '/src/Controllers/BlogController.php';
require __DIR__ . '/src/Controllers/HomeController.php';
require __DIR__ . '/src/Controllers/ProductController.php';

use Run\src\Router;
use Run\src\Response;
use Run\src\Controllers\HomeController;
use Run\src\Controllers\BlogController;
use Run\src\Controllers\ProductController;

$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->get('blog/', [BlogController::class, 'index']);
$router->get('producten/', [ProductController::class, 'index']);
$router->get('producten/bekijk/', function() {
    return (new Response())->setHttpStatus(200)
        ->setContents('<h1>Dit is een product view response dink!</h1>')
        ->setHeader('Content-Type', 'text/html')
        ->emit();
});

// The route() method SHOULD print the output of the registered function for the given path
$router->route('producten/bekijk/');