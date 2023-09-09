<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class ResizeCanvas extends Alteration implements GdAlteration
{
    public static string $id = 'resizeCanvas';

    public function applyWithGd(Image $image): mixed
    {
        // TODO: Implement applyWithGd() method.
    }
}
