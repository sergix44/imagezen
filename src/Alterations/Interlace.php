<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Interlace extends Alteration implements GdAlteration, ImagickAlteration
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

    public function applyWithImagick(Image $image): null
    {
        $image->getCore()->setInterlaceScheme($this->interlace ? \Imagick::INTERLACE_LINE : \Imagick::INTERLACE_NO);

        return null;
    }
}
