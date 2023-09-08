<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class GetHeight extends Alteration implements GdAlteration
{
    public static string $id = 'height';

    public function applyWithGd(Image $image): int
    {
        return imagesy($image->getCore());
    }
}
