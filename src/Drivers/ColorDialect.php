<?php

namespace SergiX44\ImageZen\Drivers;

use SergiX44\ImageZen\Draws\Color;

abstract class ColorDialect
{
    public function __construct(public Color $color)
    {
    }
}
