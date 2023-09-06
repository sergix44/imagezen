<?php

namespace SergiX44\ImageZen\Exceptions;

use Exception;
use Throwable;

class AlterationNotImplementedException extends Exception
{
    public function __construct(string $alteration, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("The alteration '$alteration' is not implemented on this driver.", $code, $previous);
    }
}
