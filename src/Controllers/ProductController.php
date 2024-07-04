<?php

namespace Run\Controllers;

use Run\Response;

class ProductController extends Controller
{
    /**
     * Handles the index action for the ProductController.
     */
    public function index()
    {
        $content = $this->twig->render('product/index.twig', [
            'title' => 'Product'
        ]);

        return (new Response())->setHttpStatus(200)
            ->setContents($content)
            ->setHeader('Content-Type', 'text/html');
    }
}