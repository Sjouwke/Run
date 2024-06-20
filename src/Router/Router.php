<?php

namespace Run\Router;

use Run\Response;
use Run\Router\NotFound;

class Router
{
    protected $routes = [];

    public function get(string $path, array|callable $callable)
    {
        $this->routes[$path] = $callable;
    }

    public function route(string $path)
    {
        try {
            if (!isset($this->routes[$path])) {
                throw new NotFound();
            }

            $callback = $this->routes[$path];
            $response = call_user_func($callback);

            if ($response instanceof Response) {
                $response->emit();
                return;
            }

            (new Response())->setHttpStatus(200)
                ->setContents($response)
                ->setHeader('Content-Type', 'text/plain')
                ->emit();
        } catch (NotFound $exception) {
            (new Response())->setHttpStatus($exception->getCode())
                ->setContents($exception->getMessage())
                ->setHeader('Content-Type', 'text/plain')
                ->emit();
        }
    }
}