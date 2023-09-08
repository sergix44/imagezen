<?php

namespace SergiX44\ImageZen\Drivers\Gd;

use GdImage;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\StreamInterface;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Driver;
use SergiX44\ImageZen\Exceptions\AlterationNotImplementedException;
use SergiX44\ImageZen\Exceptions\CannotLoadImageException;
use SergiX44\ImageZen\Exceptions\FormatNotSupportedException;
use SergiX44\ImageZen\Format;
use SergiX44\ImageZen\Image;

class Gd implements Driver
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

    public function newImage(int $width, int $height, Color $color): GdImage
    {
        $core = imagecreatetruecolor($width, $height);
        imagefill($core, 0, 0, $this->parseColor($color)->getInt());

        return $core;
    }

    public function parseColor(Color $color): GdColor
    {
        return new GdColor($color);
    }

    /**
     * @throws CannotLoadImageException
     */
    public function loadImageFrom(string $path): GdImage
    {
        if (file_exists($path)) {
            $resource = imagecreatefromstring(file_get_contents($path));
        } else {
            $resource = imagecreatefromstring($path);
        }

        if ($resource === false) {
            throw new CannotLoadImageException();
        }

        return $this->toTrueColor($resource);
    }

    /**
     * @throws FormatNotSupportedException
     */
    public function save(Image $image, ?string $path, Format $format, int $quality): bool
    {
        if (in_array($format, [Format::PNG, Format::WEBP, Format::AVIF], true)) {
            imagesavealpha($image->getCore(), true);
            imagealphablending($image->getCore(), $format !== Format::PNG);
        }

        if (in_array($format, [Format::WEBP, Format::AVIF], true)) {
            imagepalettetotruecolor($image->getCore());
        }

        return match ($format) {
            Format::PNG => imagepng($image->getCore(), $path, $this->mapRange($quality, 0, 100, 0, 9)),
            Format::JPG => imagejpeg($image->getCore(), $path, $quality),
            Format::WEBP => imagewebp($image->getCore(), $path, $quality),
            Format::GIF => imagegif($image->getCore(), $path),
            Format::BMP => imagebmp($image->getCore(), $path, $quality === 0),
            Format::AVIF => imageavif($image->getCore(), $path, $quality),
            default => throw new FormatNotSupportedException()
        };
    }

    public function getStream(Image $image, Format $format, int $quality): StreamInterface
    {
        ob_start();
        $this->save($image, null, $format, $quality);
        $stream = ob_get_clean();

        return Utils::streamFor($stream);
    }

    public function clear(?Image $image = null, ?object $raw = null): void
    {
        if ($image !== null) {
            imagedestroy($image->getCore());
        }

        if ($raw instanceof GdImage) {
            imagedestroy($raw);
        }
    }

    private function mapRange(int $value, int $fromMin, int $fromMax, int $toMin, int $toMax): int
    {
        $value = min(max($value, $fromMin), $fromMax);
        $fromRange = $fromMax - $fromMin;
        $toRange = $toMax - $toMin;
        $scaledValue = ($value - $fromMin) / $fromRange;

        return $toMin + ($scaledValue * $toRange);
    }

    public function clone(Image $image): GdImage
    {
        return $this->toTrueColor($image->getCore());
    }

    private function toTrueColor(GdImage $resource): GdImage
    {
        $width = imagesx($resource);
        $height = imagesy($resource);

        // new canvas
        $canvas = imagecreatetruecolor($width, $height);

        // fill with transparent color
        imagealphablending($canvas, false);
        $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
        imagefilledrectangle($canvas, 0, 0, $width, $height, $transparent);
        imagecolortransparent($canvas, $transparent);
        imagealphablending($canvas, true);

        // copy original
        imagecopy($canvas, $resource, 0, 0, 0, 0, $width, $height);

        return $canvas;
    }
}
