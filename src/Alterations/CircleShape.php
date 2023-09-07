<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use SergiX44\ImageZen\Shapes\Circle;

class CircleShape extends EllipseShape
{
    public static string $id = 'circle';

    public static string $shape = Circle::class;

    public function __construct(int $width, int $x, int $y, Closure $callback = null)
    {
        parent::__construct($width, $width, $x, $y, $callback);
    }
}
