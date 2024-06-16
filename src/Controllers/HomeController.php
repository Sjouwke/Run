<?php

namespace Run\Controllers;

use Run\Response;

class HomeController
{
    public static function index()
    {
        return (new Response())->setHttpStatus(200)
            ->setContents('Home response')
            ->setHeader('Content-Type', 'text/plain');
    }
}