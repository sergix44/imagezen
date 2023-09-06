<?php

namespace SergiX44\ImageZen\Drivers\Imagick;

use SergiX44\ImageZen\Image;

interface ImagickAlteration
{
    public function applyWithImagick(Image $image): mixed;
}
