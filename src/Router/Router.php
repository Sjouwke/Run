<?php

namespace Run\Router;

use Run\Request;
use Run\Response;
use Run\Router\NotFound;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $path, array|callable $callable)
    {
        $this->routes['GET'][$path] = $callable;
    }

    public function post(string $path, array|callable $callable)
    {
        $this->routes['POST'][$path] = $callable;
    }

    public function route(Request $request)
    {
        $path = $request->getPath();
        $method = $request->getMethod();

        $response =	(new Response())
            ->setHttpStatus(200)
            ->setHeader('Content-Type', 'text/plain');

        try {
            if (!isset($this->routes[$method][$path])) {
                throw new NotFound();
            }

            $callback = $this->routes[$method][$path];
            $output = call_user_func($callback);

            if ($output instanceof Response) {
                $output->emit();
                return;
            }

            $response->setContents($output);
        } catch (NotFound $exception) {
            $response->setHttpStatus(404)->setContents('Route not found!');
        }

        $response->emit();
    }
}