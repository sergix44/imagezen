<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Invert extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'invert';

    public function applyWithGd(Image $image): null
    {
        imagefilter($image->getCore(), IMG_FILTER_NEGATE);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $image->getCore()->negateImage(false);

        return null;
    }
}
