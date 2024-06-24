<?php

namespace Run;

class Request
{
    /**
     * Visibility:
     * 1. private (default): enkel visible/bruikbaar binnen deze class
     * 2. protected: visible & bruikbaar binnen deze class & classes extended van deze class
     * 3. public: overal beschikbaar
     */
    private string $path;
    private string $method;
    private array $input;

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function setInput(array $input): void
    {
        $this->input = $input;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getInput(): array
    {
        return $this->input;
    }

    // Callen op instantie vs. callen op classe
    public static function fromGlobals(): static
    {
        /**
         * $request is nu een instantie van zichzelf
         * Vanuit een statische methode in een class een instantie van zichzelf aanmaken: self & static
         * Static want nen extend moet hier aan kunnen, bij self zal het altijd een instantie van de class waarvan het extend is zijn
         * */
        $request = new static();
        $request->setPath(self::getPathFromGlobals());
        $request->setMethod('GET');
        $request->setInput([]);
        return $request;
    }

    private static function getPathFromGlobals(): string
    {
        $path = $_SERVER['REQUEST_URI'];

        if (substr($path, 0, 1) === '/') {
            $path = substr($path, 1);
        }
        return $path;
    }
}