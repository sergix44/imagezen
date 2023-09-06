<?php

namespace SergiX44\ImageZen\Exceptions;

use Exception;
use Throwable;

class FormatNotSupportedException extends Exception
{
    public function __construct(string $message = "The specified format is not supported by this driver.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
