<?php

namespace SergiX44\ImageZen\Exceptions;

use Exception;
use Throwable;

class InvalidEffectException extends Exception
{
    public function __construct(string $message = "The provided class is not a valid effect.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
