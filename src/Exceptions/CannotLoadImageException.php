<?php

namespace SergiX44\ImageZen\Exceptions;

use Exception;
use Throwable;

class CannotLoadImageException extends Exception
{
    public function __construct(string $message = "Cannot load an image from the specified path.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
