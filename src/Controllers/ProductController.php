<?php

namespace Run\Controllers;

use Run\Response;

class ProductController
{
    public static function index()
    {
        $response = new Response();
        $response->setHttpStatus(200);
        $response->setContents('Product response');
        $response->setHeader('Content-Type', 'text/plain');

        return $response;
    }
}