<?php

namespace Run\Controllers;

use Run\Response;

class BlogController
{
    public static function index()
    {
        $response = new Response();
        $response->setHttpStatus(200);
        $response->setContents('Blog response');
        $response->setHeader('Content-Type', 'text/plain');

        return $response;
    }
}