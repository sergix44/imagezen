<?php

namespace SergiX44\ImageZen\Drivers\Imagick;

use Imagick as ImagickBackend;
use SergiX44\ImageZen\Base\Driver;
use SergiX44\ImageZen\Format;
use SergiX44\ImageZen\Image;

class Imagick extends Driver
{
    public function isAvailable(): bool
    {
        return class_exists(class: \Imagick::class) && extension_loaded('imagick');
    }

    public function loadImageFrom(string $path): ImagickBackend
    {
        return new ImagickBackend($path);
    }

    public function save(Image $image, string $path, Format $format, int $quality): bool
    {
        // TODO: Implement save() method.
    }

    public function getStream(Image $image, int $quality): mixed
    {
        // TODO: Implement getStream() method.
    }

    public function clear(Image $image): void
    {
        $image->getCore()->clear();
    }
}
