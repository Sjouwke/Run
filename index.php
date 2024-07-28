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
    return Request::fromGlobals();
});
$request = $container->make('request');

$container->singleton('twig', function($container) {
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    return new Environment($loader);
});

// Controllers
$container->bind('HomeController', function($container) use ($request) {
    return new HomeController($container->make('twig'), $request);
});

$container->bind('BlogController', function($container) use ($request) {
    return new BlogController($container->make('twig'), $request);
});

$container->bind('ProductController', function($container) use ($request) {
    return new ProductController($container->make('twig'), $request);
});

// Routes
$router->get('', [$container->make('HomeController'), 'index']);
$router->get('blog', [$container->make('BlogController'), 'index']);
$router->get('producten', [$container->make('ProductController'), 'index']);
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