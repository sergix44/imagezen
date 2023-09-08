<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Gamma extends Alteration implements GdAlteration
{
    public static string $id = 'gamma';

    public function __construct(protected float $correction)
    {
    }

    public function applyWithGd(Image $image): null
    {
        imagegammacorrect($image->getCore(), 1, $this->correction);

        return null;
    }
}
