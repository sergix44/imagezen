<?php

namespace SergiX44\ImageZen\Alterations;

use InvalidArgumentException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Colorize extends Alteration implements GdAlteration, ImagickAlteration
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

    public function applyWithImagick(Image $image): null
    {
        // normalize colorize levels
        $red = $this->red > 0 ? $this->red / 5 : ($this->red + 100) / 100;
        $green = $this->green > 0 ? $this->green / 5 : ($this->green + 100) / 100;
        $blue = $this->blue > 0 ? $this->blue / 5 : ($this->blue + 100) / 100;

        $quantumRange = $image->getCore()->getQuantumRange();

        // apply
        $image->getCore()->levelImage(0, $red, $quantumRange['quantumRangeLong'], \Imagick::CHANNEL_RED);
        $image->getCore()->levelImage(0, $green, $quantumRange['quantumRangeLong'], \Imagick::CHANNEL_GREEN);
        $image->getCore()->levelImage(0, $blue, $quantumRange['quantumRangeLong'], \Imagick::CHANNEL_BLUE);

        return null;
    }
}
