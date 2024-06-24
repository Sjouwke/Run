<?php

namespace Run\Router;

use Run\Request;
use Run\Response;
use Run\Router\NotFound;

class Router
{
    // Array to store the registered paths
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * Registers a GET route with a path and a corresponding callable handler.
     *
     * @param string $path
     * @param array|callable $callable
     */
    public function get(string $path, array|callable $callable)
    {
        $this->routes['GET'][$path] = $callable;
    }

    /**
     * Registers a POST route with a path and a corresponding callable handler.
     *
     * @param string $path
     * @param array|callable $callable
     */
    public function post(string $path, array|callable $callable)
    {
        $this->routes['POST'][$path] = $callable;
    }

    /**
     * Routes the incoming request to the appropriate handler based on the
     * request's path and method. If the route doesn't exist in the $routes
     * array, a NotFound is thrown.
     *
     * @param Request $request
     */
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