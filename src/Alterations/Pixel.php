<?php

namespace SergiX44\ImageZen\Alterations;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Pixel extends Alteration implements GdAlteration
{
    public static string $id = 'pixel';

    public function __construct(
        protected Color $color,
        protected int $x,
        protected int $y,
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        imagesetpixel($image->getCore(), $this->x, $this->y, $driver->parseColor($this->color)->getInt());

        return null;
    }
}
