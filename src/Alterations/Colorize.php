<?php

namespace SergiX44\ImageZen\Alterations;

use InvalidArgumentException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Colorize extends Alteration implements GdAlteration
{
    public static string $id = 'colorize';

    protected int $red;
    protected int $green;
    protected int $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        if ($red < -100 || $red > 100) {
            throw new InvalidArgumentException('Red must be between 0 and 255');
        }
        if ($green < -100 || $green > 100) {
            throw new InvalidArgumentException('Green must be between 0 and 255');
        }
        if ($blue < -100 || $blue > 100) {
            throw new InvalidArgumentException('Blue must be between 0 and 255');
        }
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public function applyWithGd(Image $image): null
    {
        // normalize colorize levels
        $red = round($this->red * 2.55);
        $green = round($this->green * 2.55);
        $blue = round($this->blue * 2.55);

        // apply filter
        imagefilter($image->getCore(), IMG_FILTER_COLORIZE, $red, $green, $blue);

        return null;
    }
}
