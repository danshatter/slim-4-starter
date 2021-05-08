<?php

namespace App\Error;

use Slim\Error\AbstractErrorRenderer;
use Throwable;

class HtmlErrorRenderer extends AbstractErrorRenderer
{
    
    public function __invoke(Throwable $exception, bool $displayErrorDetails): string
    {
        return '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <!-- Required meta tags -->
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <link rel="stylesheet" href="/css/app.css">
                    <title>'.$exception->getTitle().'</title>
                </head>
                <body>
                    <h1>'.$exception->getCode().'</h1>
                    <h2>'.strtoupper($exception->getMessage()).'</h2>
                    <p>'.ucwords($exception->getDescription()).'</p>
                    <a href="/">Home</a>

                    <script src="/js/app.js"></script>
                </body>
            </html>';

    }

}
