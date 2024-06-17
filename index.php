<?php

require __DIR__ . '/src/Response.php';
require __DIR__ . '/src/Router/Router.php';
require __DIR__ . '/src/Router/NotFound.php';
require __DIR__ . '/src/Controllers/BlogController.php';
require __DIR__ . '/src/Controllers/HomeController.php';
require __DIR__ . '/src/Controllers/ProductController.php';

use Run\Router\Router;
use Run\Controllers\HomeController;
use Run\Controllers\BlogController;
use Run\Controllers\ProductController;
use Run\Router\NotFound;

$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->get('blog/', [BlogController::class, 'index']);
$router->get('producten/', [ProductController::class, 'index']);
$router->get('producten/bekijk/', function() {
    $product = null;

    if (!$product) {
        throw new NotFound();
    }

    return 'Dit is een product view!';
});

// The route() method SHOULD print the output of the registered function for the given path
$router->route('producten/bekijk/');
// $router->route('producten/');
// $router->route('ikbestanie/');