<?php

require __DIR__ . '/src/Container.php';
require __DIR__ . '/src/Response.php';
require __DIR__ . '/src/Request.php';
require __DIR__ . '/src/Router/Router.php';
require __DIR__ . '/src/Router/NotFound.php';
require __DIR__ . '/src/Controllers/BlogController.php';
require __DIR__ . '/src/Controllers/HomeController.php';
require __DIR__ . '/src/Controllers/ProductController.php';

use Run\Router\Router;
use Run\Controllers\HomeController;
use Run\Controllers\BlogController;
use Run\Controllers\ProductController;
use Run\Container;
use Run\Request;
use Run\Response;

// Container
$container = new Container();

// Dependencies
$container->bind('router', function ($container) {
    return new Router();
});
$router = $container->make('router');

$container->singleton('request', function($container) {
    return new Request();
});
$request = $container->make('request')::fromGlobals();

// Routes
$router->get('', [HomeController::class, 'index']);
$router->get('blog/', [BlogController::class, 'index']);
$router->get('producten/', [ProductController::class, 'index']);
$router->get('producten/bekijk/', function() {
    return '';
});
$router->post('send-mail/', function() {
   return (new Response())->setHttpStatus(200)
        ->setContents('Mail verstuurd')
        ->setHeader('Content-Type', 'text/plain');
});

// Response
$router->route($request);