<?php

namespace Run\Controllers;

use Run\Response;

class ProductController
{
    /**
     * Handles the index action for the ProductController.
     */
    public static function index()
    {
        return (new Response())->setHttpStatus(200)
            ->setContents('Product response')
            ->setHeader('Content-Type', 'text/plain');
    }
}