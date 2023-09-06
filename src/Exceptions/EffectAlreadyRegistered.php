<?php

namespace SergiX44\ImageZen\Exceptions;

use Exception;
use Throwable;

class EffectAlreadyRegistered extends Exception
{
    public function __construct(string $message = "The provided effect was already registered.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
