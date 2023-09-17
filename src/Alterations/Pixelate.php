<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Pixelate extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'pixelate';

    public function __construct(
        protected int $size
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        imagefilter($image->getCore(), IMG_FILTER_PIXELATE, $this->size, true);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $size = $image->getSize();

        $image->getCore()->scaleImage(
            max(1, round($size->width / $this->size)),
            max(1, round($size->height / $this->size))
        );
        $image->getCore()->scaleImage($size->width, $size->height);

        return null;
    }
}
