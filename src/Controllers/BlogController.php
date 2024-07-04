<?php

namespace Run\Controllers;

use Run\Response;

class BlogController extends Controller
{
    /**
     * Handles the index action for the BlogController.
     */
    public function index()
    {
        $content = $this->twig->render('blog/index.twig', [
            'title' => 'Blog'
        ]);

        return (new Response())->setHttpStatus(200)
            ->setContents($content)
            ->setHeader('Content-Type', 'text/html');
    }
}