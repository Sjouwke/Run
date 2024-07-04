<?php

namespace Run;

class Request
{
    // Private properties to store the path, method & and input of the request
    private string $path;
    private string $method;
    private array $input;

    /**
     * Sets the path of the request.
     *
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * Sets the method of the request.
     *
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

     /**
     * Sets the input data of the request.
     *
     * @param array $input
     */
    public function setInput(array $input): void
    {
        $this->input = $input;
    }

    /**
     * Gets the path of the request.
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Gets the method of the request.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Gets the input data of the request.
     */
    public function getInput(): array
    {
        return $this->input;
    }

    /**
     * Creates a new Request instance from global server variables.
     */
    public static function fromGlobals(): static
    {
        $request = new static();
        $request->setPath(self::getPathFromGlobals());
        $request->setMethod(self::getMethodFromGlobals());
        $request->setInput([]);
        return $request;
    }

    /**
     * Retrieves the path from the global server variables.
     */
    private static function getPathFromGlobals(): string
    {
        $path = $_SERVER['REQUEST_URI'];

        if (substr($path, 0, 1) === '/') {
            $path = substr($path, 1);
        }
        return $path;
    }

    /**
     * Retrieves the method form the global server variables.
     */
    private static function getMethodFromGlobals(): string
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        return $method;
    }
}