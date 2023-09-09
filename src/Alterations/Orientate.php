<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Orientate extends Alteration implements GdAlteration
{
    public static string $id = 'orientate';

    public function apply(Image $image): void
    {
        $arg = $image->exif('Orientation');
        if (!is_string($arg)) {
            return;
        }

        match ((int) $arg) {
            2 => $image->flip(),
            3 => $image->rotate(180),
            4 => $image->rotate(180)->flip(),
            5 => $image->rotate(270)->flip(),
            6 => $image->rotate(270),
            7 => $image->rotate(90)->flip(),
            8 => $image->rotate(90),
        };
    }

    public function applyWithGd(Image $image): null
    {
        $this->apply($image);

        return null;
    }
}
