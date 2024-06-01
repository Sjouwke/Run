<?php

class Router {
    protected $routes = [];

    public function route() {
    }

	public function get(string $path, array|callable $function) {
		var_dump($path, $function);
    }
}