<?php

namespace Run\Router;

use Exception;

/**
 * Extend from built in PHP Exception class.
 * Info: https://www.php.net/manual/en/language.exceptions.extending.php
 */
class NotFound extends Exception
{
    protected $message = 'Route not found';
    protected $code = 404;
}