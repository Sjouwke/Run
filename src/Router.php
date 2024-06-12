<?php

namespace Run\src;

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
            $callable = $this->routes[$path];

            echo call_user_func($callable);
        }
    }
}