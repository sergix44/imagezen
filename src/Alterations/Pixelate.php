<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Pixelate extends Alteration implements GdAlteration
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
}
