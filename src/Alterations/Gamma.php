<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Gamma extends Alteration implements GdAlteration, ImagickAlteration
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

    public function applyWithImagick(Image $image): null
    {
        $image->getCore()->gammaImage($this->correction);

        return null;
    }
}
