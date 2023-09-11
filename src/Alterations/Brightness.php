<?php

namespace SergiX44\ImageZen\Alterations;

use InvalidArgumentException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Brightness extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'brightness';

    protected int $level = 0;

    public function __construct(?int $level = null)
    {
        if ($level !== null) {
            if ($level < -100 || $level > 100) {
                throw new InvalidArgumentException('Brightness $level must be between -100 and 100');
            }
            $this->level = $level;
        }
    }

    public function applyWithGd(Image $image): null
    {
        imagefilter($image->getCore(), IMG_FILTER_BRIGHTNESS, round($this->level * 2.55, 0));

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $image->getCore()->modulateImage(100 + $this->level, 100, 100);

        return null;
    }
}
