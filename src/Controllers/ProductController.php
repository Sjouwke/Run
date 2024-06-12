<?php

namespace Run\src\Controllers;

use Run\src\Response;

class ProductController
{
    public static function index()
    {
        $response = new Response();
        $response->setHttpStatus(200);
        $response->setContents('Product response');
        $response->setHeader('Content-Type', 'text/plain');

        return $response->emit();
    }
}