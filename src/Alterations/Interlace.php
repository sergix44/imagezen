<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Interlace extends Alteration implements GdAlteration
{
    public static string $id = 'interlace';

    public function __construct(protected bool $interlace)
    {
    }

    public function applyWithGd(Image $image): null
    {
        imageinterlace($image->getCore(), $this->interlace);

        return null;
    }
}
