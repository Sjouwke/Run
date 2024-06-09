<?php

include 'router.php';
include 'controllers/BlogController.php';
include 'controllers/HomeController.php';
include 'controllers/ProductController.php';

// The Router class DOES NOT take any arguments to be initialized
$router = new Router();

// The get() method MUST take as a first argument a path and as the second argument a callable (function)
$router->get('/', [HomeController::class, 'index']);
$router->get('blog/', [BlogController::class, 'index']);
$router->get('producten/', [ProductController::class, 'index']);
$router->get('producten/bekijk/', function() {
	echo 'Dit is een product view!';
});

// The route() method SHOULD print the output of the registered function for the given path
$router->route('producten/bekijk/');