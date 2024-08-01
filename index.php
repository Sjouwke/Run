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

// Dependencies
Container::singleton('view', function() {
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    return new Environment($loader);
});

Container::singleton('request', function() {
    return Request::fromGlobals();
});
$request = Container::make('request');

Container::singleton('router', function () {
    return new Router();
});
$router = Container::make('router');

// Controllers
Container::bind('HomeController', function() {
    return new HomeController();
});

Container::bind('BlogController', function() {
    return new BlogController();
});

Container::bind('ProductController', function() {
    return new ProductController();
});

// Routes
$router->get('', [HomeController::class, 'index']);
$router->get('blog', [BlogController::class, 'index']);
$router->get('producten', [ProductController::class, 'index']);
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