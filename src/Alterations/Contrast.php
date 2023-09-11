<?php

namespace SergiX44\ImageZen\Alterations;

use InvalidArgumentException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Contrast extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'contrast';
    private int $level;

    public function __construct(int $level)
    {
        if ($level < -100 || $level > 100) {
            throw new InvalidArgumentException('Contrast level must be between -100 and 100');
        }
        $this->level = $level;
    }

    public function applyWithGd(Image $image): null
    {
        imagefilter($image->getCore(), IMG_FILTER_CONTRAST, ($this->level * -1));

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $image->getCore()->sigmoidalContrastImage($this->level > 0, $this->level / 4, 0);

        return null;
    }
}
