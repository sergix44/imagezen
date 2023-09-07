<?php

namespace SergiX44\ImageZen\Shapes;

class Point
{
    public function __construct(public int $x = 0, public int $y = 0)
    {
    }

    public function x(int $x)
    {
        $this->x = $x;
    }

    public function y(int $y)
    {
        $this->y = $y;
    }

    /**
     * Sets both X and Y coordinate
     */
    public function setPosition(int $x, int $y)
    {
        $this->x($x);
        $this->y($y);
    }
}
