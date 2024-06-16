<?php

namespace Run\Router;

use Exception;

/**
 * Extend from build in PHP Exception class.
 * Info: https://www.php.net/manual/en/language.exceptions.extending.php
 */
class NotFound extends Exception
{
    protected $code = 404;
    protected $message = 'Route not found';
}