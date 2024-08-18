<?php

namespace Run\Router;

use Run\Request;
use Run\Response;
use Run\Router\NotFound;

class Router
{
    // Protected array to store the registered paths
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    // Protected array to store the error routes
    protected $errors = [];

    /**
     * Registers a GET route with a path and a corresponding callable handler.
     *
     * @param string $path
     * @param array|callable $callable
     */
    public function get(string $path, array|callable $callable): void
    {
        $this->routes['GET'][$path] = $callable;
    }

    /**
     * Registers an error route with a http status code and a corresponding callable handler.
     *
     * @param int $httpStatusCode
     * @param array|callable $callable
     */
    public function registerError(int $httpStatusCode, array|callable $callable): void
    {
        $this->errors[$httpStatusCode] = $callable;
    }

    /**
     * Registers a POST route with a path and a corresponding callable handler.
     *
     * @param string $path
     * @param array|callable $callable
     */
    public function post(string $path, array|callable $callable): void
    {
        $this->routes['POST'][$path] = $callable;
    }

    private function emitResponse(callable $callable, Request $request, int $httpStatusCode = 200): void
    {
        $response =	(new Response())
            ->setHttpStatus($httpStatusCode)
            ->setHeader('Content-Type', 'text/html');

        $output = call_user_func($callable, $request);

        if ($output instanceof Response) {
            $output->emit();
            return;
        }

        $response->setContents($output)->emit();
    }

    /**
     * Routes the incoming request to the appropriate handler based on the
     * request's path and method. If the route doesn't exist in the $routes
     * array, a NotFound is thrown.
     *
     * @param Request $request
     */
    public function route(Request $request): void
    {
        $path = $request->getPath();
        $method = $request->getMethod();

        try {
            if (!isset($this->routes[$method][$path])) {
                throw new NotFound();
            }

            $this->emitResponse($this->routes[$method][$path], $request, 200);

        } catch (NotFound $exception) {

            if(!isset($this->errors[404])) {
                $this->errors[404] = fn($request) => 'Error 404';
            }

            $this->emitResponse($this->errors[404], $request, 404);
        }
    }
}