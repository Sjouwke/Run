<?php

namespace Run;

use Exception;

class Container
{
    // Protected array to store bindings - registered functions that create instances
    protected $bindings = [];

    // Protected array to store singleton dependencies
    protected $singletons = [];

    // Protected array to store instantiated singletons
    protected $instances = [];

    /**
     * Bind dependencies under a certain name
     *
     * @param string $name
     * @param callable $resolver
     */
    public function bind(string $name, callable $resolver): void
    {
        $this->bindings[$name] = $resolver;
    }

    /**
     * Bind singletons under a certain name
     *
     * $param string $name
     * $param callable $resolver
     */
    public function singleton(string $name, callable $resolver): void
    {
        $this->singletons[$name] = $resolver;
    }

    /**
     * Make dependencies, based on what's been registered
     *
     * @param string $name
     */
    public function make(string $name): mixed
    {
        if (isset($this->bindings[$name])) {
            return $this->bindings[$name]($this);
        }

        if (isset($this->singletons[$name])) {
            if (!isset($this->instances[$name])) {
                $this->instances[$name] = $this->singletons[$name]($this);
            }
            return $this->instances[$name];
        }

        throw new Exception('Dependency not found');
    }
}
