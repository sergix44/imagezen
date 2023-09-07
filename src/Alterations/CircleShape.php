<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;

class CircleShape extends EllipseShape
{
    public static string $id = 'circle';

    public function __construct(int $width, int $x, int $y, Closure $callback = null)
    {
        parent::__construct($width, $width, $x, $y, $callback);
    }

}
