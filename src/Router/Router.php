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
        $response =	(new Response())
            ->setHttpStatus(200)
            ->setHeader('Content-Type', 'text/plain');

        try {
            if (!isset($this->routes[$path])) {
                throw new NotFound();
            }

            $callback = $this->routes[$path];
            $output = call_user_func($callback);

            if ($output instanceof Response) {
                $output->emit();
                return;
            }

            $response->setContents($output);
        } catch (NotFound $exception) {
            $response->setHttpStatus(404)->setContents($exception->getMessage());
        }

        $response->emit();
    }
}