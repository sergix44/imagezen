<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Crop extends Alteration implements GdAlteration
{
    public static string $id = 'crop';

    public function __construct(
        public int $x,
        public int $y,
        public ?int $width = null,
        public ?int $height = null,
    ) {
    }

    public function applyWithGd(Image $image): mixed
    {
        // TODO: Implement applyWithGd() method.
    }
}
