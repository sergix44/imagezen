<?php

namespace SergiX44\ImageZen\Drivers\Gd;

use GdImage;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Driver;
use SergiX44\ImageZen\Exceptions\AlterationNotImplementedException;
use SergiX44\ImageZen\Exceptions\CannotLoadImageException;
use SergiX44\ImageZen\Exceptions\FormatNotSupportedException;
use SergiX44\ImageZen\Format;
use SergiX44\ImageZen\Image;

class Gd extends Driver
{
    public function isAvailable(): bool
    {
        return extension_loaded('gd') && function_exists('gd_info');
    }

    /**
     * @param  Alteration  $alteration
     * @param  Image  $image
     * @return mixed
     * @throws AlterationNotImplementedException
     */
    public function apply(Alteration $alteration, Image $image): mixed
    {
        if (!$alteration instanceof GdAlteration) {
            throw new AlterationNotImplementedException($alteration::$id);
        }

        return $alteration->applyWithGd($image);
    }

    /**
     * @throws CannotLoadImageException
     */
    public function loadImageFrom(string $path): GdImage
    {
        $image = imagecreatefromstring(file_get_contents($path));

        if ($image === false) {
            throw new CannotLoadImageException();
        }

        return $image;
    }

    /**
     * @throws FormatNotSupportedException
     */
    public function save(Image $image, string $path, Format $format, int $quality): bool
    {
        return match ($format) {
            Format::PNG => imagepng($image->getCore(), $path, $this->mapRange($quality, 0, 100, 0, 9)),
            Format::JPG => imagejpeg($image->getCore(), $path, $quality),
            Format::WEBP => imagewebp($image->getCore(), $path, $quality),
            Format::GIF => imagegif($image->getCore(), $path),
            Format::BMP => imagebmp($image->getCore(), $path, $quality === 0),
            default => throw new FormatNotSupportedException()
        };
    }

    public function getStream(Image $image, int $quality): mixed
    {
        // TODO: Implement getStream() method.
    }

    public function clear(Image $image): void
    {
        imagedestroy($image->getCore());
    }
}
