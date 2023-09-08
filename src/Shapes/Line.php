<?php

namespace SergiX44\ImageZen\Shapes;

use InvalidArgumentException;
use SergiX44\ImageZen\Draws\Color;

class Line extends Shape
{
    public function __construct()
    {
        $this->borderWidth = 1;
        $this->borderColor = Color::black();
    }

    public function width(int $width): self
    {
        $this->borderWidth = $width;

        return $this;
    }

    public function color(Color $color): self
    {
        $this->borderColor = $color;

        return $this;
    }

    public function background(Color $color): self
    {
        throw new InvalidArgumentException('A line cannot have a background color');
    }
}
