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
        $content = $this->twig->render('pages/product/index.twig', [
            'page' => 'Product'
        ]);

        return (new Response())->setHttpStatus(200)
            ->setContents($content)
            ->setHeader('Content-Type', 'text/html');
    }
}