<?php

namespace SergiX44\ImageZen\Exceptions;

use Exception;
use Throwable;

class InvalidAlterationException extends Exception
{
    public function __construct(string $message = "The provided class is not a valid alteration.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
