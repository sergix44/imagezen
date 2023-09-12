<?php

namespace SergiX44\ImageZen\Getters;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class GetWidth extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'width';

    public function applyWithGd(Image $image): int
    {
        return imagesx($image->getCore());
    }

    public function applyWithImagick(Image $image): int
    {
        return $image->getCore()->getImageWidth();
    }
}
