<?php

namespace SergiX44\ImageZen\Exceptions;

use Exception;
use Throwable;

class EffectNotImplementedException extends Exception
{

    public function __construct(string $effect, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("The effect '$effect' is not implemented on this driver.", $code, $previous);
    }
}
