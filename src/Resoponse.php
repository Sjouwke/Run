<?php

namespace Run\src;

class Response
{
    protected $httpStatus = 200;
    protected $contents = '';
    protected $header = [];

    public function setHttpStatus(int $statusCode)
    {
        $this->httpStatus = $statusCode;
    }

    public function setContents(string $content)
    {
        $this->contents = $content;
    }

    public function setHeader(string $name, string $value)
    {
        $this->header[$name] = $value;
    }

    public function emit()
    {
        http_response_code($this->httpStatus);

        foreach($this->header as $name => $value) {
            header("$name: $value");
        }

        echo $this->contents;
    }
}