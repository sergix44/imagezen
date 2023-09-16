<?php

namespace SergiX44\ImageZen\Alterations;

use InvalidArgumentException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Opacity extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'opacity';

    protected int $transparency;

    public function __construct(int $transparency)
    {
        if ($transparency < 0 || $transparency > 100) {
            throw new InvalidArgumentException('Transparency must be between 0 and 100');
        }
        $this->transparency = $transparency;
    }

    public function applyWithGd(Image $image): null
    {
        $opacity = $this->transparency / 100;
        imagealphablending($image->getCore(), false); // imagesavealpha can only be used by doing this for some reason
        imagesavealpha($image->getCore(), true); // this one helps you keep the alpha.
        $transparency = 1 - $opacity;
        imagefilter($image->getCore(), IMG_FILTER_COLORIZE, 0, 0, 0, 127 * $transparency); // the fourth parameter is alpha

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $opacity = $this->transparency > 0 ? (100 / $this->transparency) : 1000;
        $image->getCore()->evaluateImage(\Imagick::EVALUATE_DIVIDE, $opacity, \Imagick::CHANNEL_ALPHA);

        return null;
    }
}
