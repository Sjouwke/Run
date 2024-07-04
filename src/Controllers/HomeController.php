<?php

namespace Run\Controllers;

use Run\Response;

class HomeController extends Controller
{
    /**
     * Handles the index action for the HomeController.
     */
    public function index()
    {
        $content = $this->twig->render('home/index.twig', [
            'title' => 'Home'
        ]);

        return (new Response())->setHttpStatus(200)
            ->setContents($content)
            ->setHeader('Content-Type', 'text/html');
    }
}