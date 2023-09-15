<?php

namespace SergiX44\ImageZen\Getters;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class GetColor extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'pickColor';

    public function __construct(
        protected int $x,
        protected int $y,
    ) {
    }

    public function applyWithGd(Image $image): Color
    {
        $colorInt = imagecolorat($image->getCore(), $this->x, $this->y);

        if (!imageistruecolor($image->getCore())) {
            $colorArray = imagecolorsforindex($image->getCore(), $colorInt);
            $colorArray['alpha'] = round(1 - $colorArray['alpha'] / 127, 2);

            return Color::rgba($colorArray['red'], $colorArray['green'], $colorArray['blue'], $colorArray['alpha']);
        }

        return Color::fromInt($colorInt);
    }

    public function applyWithImagick(Image $image): Color
    {
        $pixel = $image->getCore()->getImagePixelColor($this->x, $this->y);
        $colors = $pixel->getColor();
        $colors['a'] = round($pixel->getColorValue(\Imagick::COLOR_ALPHA), 2);

        return Color::rgba(...array_values($colors));
    }
}
