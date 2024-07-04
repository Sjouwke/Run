<?php

require 'vendor/autoload.php';

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

// Controllers
$container->bind('HomeController', function($container) {
    return new HomeController();
});

$container->bind('BlogController', function($container) {
    return new BlogController();
});

$container->bind('ProductController', function($container) {
    return new ProductController();
});

// Routes
$router->get('', [$container->make('HomeController'), 'index']);
$router->get('blog/', [$container->make('BlogController'), 'index']);
$router->get('producten/', [$container->make('ProductController'), 'index']);
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