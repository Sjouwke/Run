<?php

namespace Run\src\Controllers;

use Run\src\Response;

class HomeController
{
    public static function index()
    {
        $response = new Response();
        $response->setHttpStatus(200);
        $response->setContents('Home response');
        $response->setHeader('Content-Type', 'text/plain');

        return $response->emit();
    }
}