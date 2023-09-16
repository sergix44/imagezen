<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class GreyScale extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'greyscale';

    public function applyWithGd(Image $image): null
    {
        imagefilter($image->getCore(), IMG_FILTER_GRAYSCALE);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $image->getCore()->modulateImage(100, 0, 100);

        return null;
    }
}
