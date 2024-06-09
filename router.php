<?php

class Router {
	protected $routes = [];

	public function get(string $path, array|callable $callable) {
		$this->routes[$path] = $callable;
	}

	public function route(string $path) {
		if (isset($this->routes[$path])) {
			$callable = $this->routes[$path];

			if (is_callable($callable)) {
				call_user_func($callable);
			} else {
				list($class, $method) = $callable;

				if (class_exists($class) && method_exists($class, $method)) {
					$controller = new $class();

					echo $controller->$method();
				} else {
					echo "Callable does not exist.";
				}
			}

		} else {
			echo "Route does not exist.";
		}
	}
}
