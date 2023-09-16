<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Sharpen extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'sharpen';

    public function __construct(
        public int $amount,
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        // build matrix
        $min = $this->amount >= 10 ? $this->amount * -0.01 : 0;
        $max = $this->amount * -0.025;
        $abs = ((4 * $min + 4 * $max) * -1) + 1;
        $div = 1;

        $matrix = [
            [$min, $max, $min],
            [$max, $abs, $max],
            [$min, $max, $min],
        ];

        // apply the matrix
        imageconvolution($image->getCore(), $matrix, $div, 0);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $image->getCore()->unsharpMaskImage(1, 1, $this->amount / 6.25, 0);

        return null;
    }
}
