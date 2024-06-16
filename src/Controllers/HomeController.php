<?php

namespace Run\Controllers;

use Run\Response;

class HomeController
{
    public static function index()
    {
        $response = new Response();
        $response->setHttpStatus(200);
        $response->setContents('Home response');
        $response->setHeader('Content-Type', 'text/plain');

       	return $response;
    }
}