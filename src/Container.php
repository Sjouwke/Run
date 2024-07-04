<?php

namespace Run;

use Exception;

class Container
{
    // Protected array to store bindings - registered functions that create instances
    protected $bindings = [];

    // Protected array to store singleton dependencies
    protected $singletons = [];

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
            return $this->singletons[$name]($this);
        }

        throw new Exception('Dependency not found');
    }
}

// if (isset($this->singletons[$name])) {
//     // If the singleton is defined and instantiated, return it directly
//     if (!isset($this->singletons[$name]['instance'])) {
//         // If the singleton instance doesn't exist, create it and store it
//         $this->singletons[$name]['instance'] = $this->singletons[$name]['resolver']($this);
//     }
//     // Return the stored instance
//     return $this->singletons[$name]['instance'];
// }

// if (isset($this->bindings[$name])) {
//     // If there's a binding for the name, invoke it and return the result
//     return $this->bindings[$name]($this);
// }