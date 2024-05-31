<?php

class Router {
    protected $routes = []; // stores routes

    public function addRoute(string $method, string $url, closure $target) {
        $this->routes[$method][$url] = $target;
    }

    public function route() {
    }

	public function get() {
    }
}