<?php

require 'vendor/autoload.php';

use Run\Router\Router;
use Run\Controllers\HomeController;
use Run\Controllers\BlogController;
use Run\Controllers\ProductController;
use Run\Container;
use Run\Request;
use Run\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

$container->singleton('twig', function($container) {
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    return new Environment($loader);
});

// Controllers
$container->bind('HomeController', function($container) {
    return new HomeController($container->make('twig'));
});

$container->bind('BlogController', function($container) {
    return new BlogController($container->make('twig'));
});

$container->bind('ProductController', function($container) {
    return new ProductController($container->make('twig'));
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