<?php

namespace SergiX44\ImageZen\Drivers;

use GdImage;
use Imagick;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Format;
use SergiX44\ImageZen\Image;

abstract class Driver
{
    abstract public function isAvailable(): bool;

    abstract public function loadImageFrom(string $path): GdImage|Imagick;

    abstract public function save(Image $image, string $path, Format $format, int $quality): bool;

    abstract public function getStream(Image $image, int $quality): mixed;

    abstract public function clear(Image $image): void;

    abstract public function apply(Alteration $alteration, Image $image): mixed;

    protected function mapRange(int $value, int $fromMin, int $fromMax, int $toMin, int $toMax): int
    {
        $value = min(max($value, $fromMin), $fromMax);
        $fromRange = $fromMax - $fromMin;
        $toRange = $toMax - $toMin;
        $scaledValue = ($value - $fromMin) / $fromRange;

        return $toMin + ($scaledValue * $toRange);
    }
}
