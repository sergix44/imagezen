<?php

namespace SergiX44\ImageZen\Getters;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class GetFilesize extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'filesize';

    public function applyWithGd(Image $image): int
    {
        return $image->stream()->getSize();
    }

    public function applyWithImagick(Image $image): mixed
    {
        return $image->getCore()->getImageLength();
    }
}
