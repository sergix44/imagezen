<?php

namespace SergiX44\ImageZen;

use GdImage;
use Imagick;

abstract class Alteration
{
    public static string $id;

    public static function make(...$args): self
    {
        return new static(...$args);
    }

    protected function replaceCore(Image $image, GdImage|Imagick $new): void
    {
        (function ($new) {
            $this->image = $new;
        })->call($image, $new);
    }
}
