<?php

namespace SergiX44\ImageZen\Drivers\Gd;

use SergiX44\ImageZen\Image;

interface GdAlteration
{
    public function applyWithGd(Image $image): mixed;
}
