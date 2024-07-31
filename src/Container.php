<?php

namespace Run;

use Exception;

class Container
{
    // Static array to store bindings - registered functions that create instances
    protected static $bindings = [];

    // Static array to store singleton dependencies
    protected static $singletons = [];

    // Static array to store instantiated singletons
    protected static $instances = [];

    /**
     * Bind dependencies under a certain name
     *
     * @param string $name
     * @param callable $resolver
     */
    public static function bind(string $name, callable $resolver): void
    {
        self::$bindings[$name] = $resolver();
    }

    /**
     * Bind singletons under a certain name
     *
     * $param string $name
     * $param callable $resolver
     */
    public static function singleton(string $name, callable $resolver): void
    {
        self::$singletons[$name] = $resolver;
    }

    /**
     * Make dependencies, based on what's been registered
     *
     * @param string $name
     */
    public static function make(string $name): mixed
    {
        if (isset(self::$bindings[$name])) {
            return self::$bindings[$name];
        }

        if (isset(self::$singletons[$name])) {
            if (!isset(self::$instances[$name])) {
                self::$instances[$name] = self::$singletons[$name];
            }
            return self::$instances[$name]();
        }

        throw new Exception('Dependency not found');
    }
}
