<?php

namespace SergiX44\ImageZen\Alterations;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Pixel extends Alteration implements GdAlteration, ImagickAlteration
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

    public function applyWithImagick(Image $image): null
    {
        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $draw = new \ImagickDraw();
        $draw->setFillColor($driver->parseColor($this->color)->getPixel());
        $draw->point($this->x, $this->y);
        $image->getCore()->drawImage($draw);

        return null;
    }
}
