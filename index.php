<?php

require __DIR__ . '/src/Router.php';
require __DIR__ . '/src/controllers/BlogController.php';
require __DIR__ . '/src/controllers/HomeController.php';
require __DIR__ . '/src/controllers/ProductController.php';

use Run\Router;
use Run\controllers\HomeController;
use Run\controllers\BlogController;
use Run\controllers\ProductController;

// The Router class DOES NOT take any arguments to be initialized
$router = new Router();

// The get() method MUST take as a first argument a path and as the second argument a callable (function)
$router->get('/', [HomeController::class, 'index']);
$router->get('blog/', [BlogController::class, 'index']);
$router->get('producten/', [ProductController::class, 'index']);
$router->get('producten/bekijk/', function() {
    return 'Dit is een product view!';
});

// The route() method SHOULD print the output of the registered function for the given path
$router->route('producten/');