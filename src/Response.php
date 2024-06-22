<?php

namespace Run;

class Response
{
    protected $httpStatus = 200;
    protected $contents = '';
    protected $header = [];

    public function setHttpStatus(int $statusCode): self
    {
        $this->httpStatus = $statusCode;
        return $this;
    }

    public function setContents(string $contents): self
    {
        $this->contents = $contents;
        return $this;
    }

    public function setHeader(string $name, string $value): self
    {
        $this->header[$name] = $value;
        return $this;
    }

    public function emit(): void
    {
        http_response_code($this->httpStatus);

        foreach($this->header as $name => $value) {
            header("$name: $value");
        }

        echo $this->contents;
    }
}