<?php

namespace Run;

class Router
{
    protected $routes = [];

    public function get(string $path, array|callable $callable)
    {
        $this->routes[$path] = $callable;
    }

    public function route(string $path)
    {
        if (isset($this->routes[$path])) {
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
        }
    }
}