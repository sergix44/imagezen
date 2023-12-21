<?php

namespace SergiX44\ImageZen\Getters;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class GetMime extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'mime';

    public function applyWithGd(Image $image): string
    {
        $imageInfo = $image->getDriver()->getData();

        return $imageInfo['mime'];
    }

    public function applyWithImagick(Image $image): string
    {
        return str_ireplace('/x-', '/', $image->getCore()->getImageMimeType());
    }
}
