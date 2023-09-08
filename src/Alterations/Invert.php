<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Invert extends Alteration implements GdAlteration
{
    public static string $id = 'invert';

    public function applyWithGd(Image $image): null
    {
        imagefilter($image->getCore(), IMG_FILTER_NEGATE);

        return null;
    }
}
