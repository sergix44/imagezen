<?php

namespace SergiX44\ImageZen\Drivers;

use GdImage;
use Imagick;
use Psr\Http\Message\StreamInterface;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Format;
use SergiX44\ImageZen\Image;

interface Driver
{
    public function isAvailable(): bool;

    public function loadImageFrom(string $path): GdImage|Imagick;

    public function newImage(int $width, int $height, Color $color): GdImage|Imagick;

    public function parseColor(Color $color): ColorDialect;

    public function save(Image $image, string $path, Format $format, int $quality): bool;

    public function getStream(Image $image, Format $format, int $quality): StreamInterface;

    public function clone(Image $image): GdImage|Imagick;

    public function clear(?Image $image = null, ?object $raw = null): void;

    public function apply(Alteration $alteration, Image $image): mixed;

    public function getData(): array;
}
