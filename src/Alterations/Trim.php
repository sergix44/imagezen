<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Trim extends Alteration implements GdAlteration
{
    public static string $id = 'trim';

    public function applyWithGd(Image $image): null
    {
        return null;
    }
}
