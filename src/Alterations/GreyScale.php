<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class GreyScale extends Alteration implements GdAlteration
{
    public static string $id = 'greyscale';

    public function applyWithGd(Image $image): null
    {
        imagefilter($image->getCore(), IMG_FILTER_GRAYSCALE);
        return null;
    }

}
