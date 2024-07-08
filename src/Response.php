<?php

namespace Run;

class Response
{
    // Protected properties to store HTTP status, response content, and headers
    protected $httpStatus = 200;
    protected $contents = '';
    protected $header = [];

    /**
     * Sets the HTTP status code for the response.
     *
     * @param int $statusCode
     */
    public function setHttpStatus(int $statusCode): self
    {
        $this->httpStatus = $statusCode;
        return $this;
    }

    /**
     * Sets the content of the response.
     *
     * @param string $contents
     */
    public function setContents(string $contents): self
    {
        $this->contents = $contents;
        return $this;
    }

    /**
     * Sets a header for the response.
     *
     * @param string $name
     * @param string $value
     */
    public function setHeader(string $name, string $value): self
    {
        $this->header[$name] = $value;
        return $this;
    }

    /**
     * Sets the HTTP status code and header, and outputs the response content.
     */
    public function emit(): void
    {
        http_response_code($this->httpStatus);

        foreach($this->header as $name => $value) {
            header("$name: $value");
        }

        echo $this->contents;
    }
}