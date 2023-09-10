<?php

namespace SergiX44\ImageZen\Draws;

use SergiX44\ImageZen\Shapes\Point;

class Box
{
    public Point $lowerLeft;
    public Point $lowerRight;
    public Point $upperRight;
    public Point $upperLeft;

    public function __construct(Point $lowerLeft, Point $lowerRight, Point $upperRight, Point $upperLeft)
    {
        $this->lowerLeft = $lowerLeft;
        $this->lowerRight = $lowerRight;
        $this->upperRight = $upperRight;
        $this->upperLeft = $upperLeft;
    }

    public function getSize(): Size
    {
        return new Size(
            $this->upperRight->x - $this->lowerLeft->x,
            $this->upperRight->y - $this->lowerLeft->y,
            $this->upperLeft
        );
    }
}
