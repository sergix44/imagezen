<?php

namespace SergiX44\ImageZen\Exceptions;

use Exception;
use Throwable;

class AlterationAlreadyRegistered extends Exception
{
    public function __construct(string $message = "The provided alteration was already registered.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
