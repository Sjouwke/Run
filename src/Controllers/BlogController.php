<?php

namespace Run\Controllers;

use Run\Response;

class BlogController
{
    public static function index()
    {
        return (new Response())->setHttpStatus(200)
            ->setContents('Blog response')
            ->setHeader('Content-Type', 'text/plain');
    }
}