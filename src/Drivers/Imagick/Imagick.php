<?php

namespace SergiX44\ImageZen\Drivers\Imagick;

use GuzzleHttp\Psr7\Utils;
use Imagick as ImagickBackend;
use Psr\Http\Message\StreamInterface;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\DecodeDataUriImage;
use SergiX44\ImageZen\Drivers\Driver;
use SergiX44\ImageZen\Exceptions\AlterationNotImplementedException;
use SergiX44\ImageZen\Exceptions\CannotLoadImageException;
use SergiX44\ImageZen\Exceptions\FormatNotSupportedException;
use SergiX44\ImageZen\Format;
use SergiX44\ImageZen\Image;

class Imagick implements Driver
{
    use DecodeDataUriImage;

    public function isAvailable(): bool
    {
        return class_exists(class: \Imagick::class) && extension_loaded('imagick');
    }

    /**
     * @param  Alteration  $alteration
     * @param  Image  $image
     * @return mixed
     * @throws AlterationNotImplementedException
     */
    public function apply(Alteration $alteration, Image $image): mixed
    {
        if (!$alteration instanceof ImagickAlteration) {
            throw new AlterationNotImplementedException($alteration::$id);
        }

        return $alteration->applyWithImagick($image);
    }

    public function loadImageFrom(string $path): ImagickBackend
    {
        $imagick = new ImagickBackend();
        $imagick->setBackgroundColor(new \ImagickPixel('transparent'));

        try {
            if (file_exists($path)) {
                $imagick->readImage($path);
                $imagick->setImageType(defined('\Imagick::IMGTYPE_TRUECOLORALPHA') ? \Imagick::IMGTYPE_TRUECOLORALPHA : \Imagick::IMGTYPE_TRUECOLORMATTE);
            } else {
                if ($this->isDataUriImage($path)) {
                    $path = $this->decodeDataUriImage($path);
                }
                $imagick->readImageBlob($path);
            }
        } catch (\ImagickException $e) {
            throw new CannotLoadImageException(previous: $e);
        }

        return $imagick;
    }

    public function newImage(int $width, int $height, Color $color): ImagickBackend
    {
        $core = new ImagickBackend();
        $core->newImage($width, $height, $this->parseColor($color)->getPixel(), 'png');
        $core->setType(ImagickBackend::IMGTYPE_UNDEFINED);
        $core->setImageType(ImagickBackend::IMGTYPE_UNDEFINED);
        $core->setColorspace(ImagickBackend::COLORSPACE_UNDEFINED);

        return $core;
    }

    public function parseColor(Color $color): ImagickColor
    {
        return new ImagickColor($color);
    }

    public function clear(?Image $image = null, ?object $raw = null): void
    {
        $image?->getCore()->clear();
        if ($raw instanceof ImagickBackend) {
            $raw->clear();
        }
    }

    public function save(Image $image, string $path, Format $format, int $quality): bool
    {
        $imagick = $this->processFormat($image->getCore(), $format, $quality);

        return $imagick->writeImage($path);
    }

    public function getStream(Image $image, Format $format, int $quality): StreamInterface
    {
        $imagick = $this->processFormat($image->getCore(), $format, $quality);

        return Utils::streamFor($imagick->getImageBlob());
    }

    private function processFormat(ImagickBackend $imagick, Format $format, int $quality): ImagickBackend
    {
        return match ($format) {
            Format::PNG => $this->processPng($imagick),
            Format::JPG => $this->processJpg($imagick, $quality),
            Format::GIF => $this->processGif($imagick),
            Format::WEBP => $this->processWebp($imagick, $quality),
            Format::TIFF => $this->processTiff($imagick, $quality),
            Format::BMP => $this->processBmp($imagick),
            Format::AVIF => $this->processAvif($imagick, $quality),
            Format::HEIC => $this->processHeic($imagick, $quality),
            default => throw new FormatNotSupportedException(),
        };
    }

    private function processPng(ImagickBackend $imagick): ImagickBackend
    {
        $format = 'png';
        $compression = ImagickBackend::COMPRESSION_ZIP;

        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick;
    }

    private function processJpg(ImagickBackend $imagick, int $quality): ImagickBackend
    {
        $format = 'jpeg';
        $compression = ImagickBackend::COMPRESSION_JPEG;

        $imagick->setImageBackgroundColor('white');
        $imagick->setBackgroundColor('white');
        $imagick = $imagick->mergeImageLayers(ImagickBackend::LAYERMETHOD_MERGE);
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);
        $imagick->setCompressionQuality($quality);
        $imagick->setImageCompressionQuality($quality);

        return $imagick;
    }

    private function processGif(ImagickBackend $imagick): ImagickBackend
    {
        $format = 'gif';
        $compression = ImagickBackend::COMPRESSION_LZW;

        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick;
    }

    private function processWebp(ImagickBackend $imagick, int $quality): ImagickBackend
    {
        if (!ImagickBackend::queryFormats('WEBP')) {
            throw new FormatNotSupportedException(
                "Webp format is not supported by Imagick installation."
            );
        }

        $format = 'webp';
        $compression = ImagickBackend::COMPRESSION_JPEG;

        $imagick->setImageBackgroundColor(new \ImagickPixel('transparent'));
        $imagick = $imagick->mergeImageLayers(ImagickBackend::LAYERMETHOD_MERGE);
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);
        $imagick->setImageCompressionQuality($quality);

        return $imagick;
    }

    private function processTiff(ImagickBackend $imagick, int $quality): ImagickBackend
    {
        $format = 'tiff';
        $compression = ImagickBackend::COMPRESSION_UNDEFINED;

        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);
        $imagick->setCompressionQuality($quality);
        $imagick->setImageCompressionQuality($quality);

        return $imagick;
    }

    private function processBmp(ImagickBackend $imagick): ImagickBackend
    {
        $format = 'bmp';
        $compression = ImagickBackend::COMPRESSION_UNDEFINED;

        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick;
    }

    private function processIco(ImagickBackend $imagick): ImagickBackend
    {
        $format = 'ico';
        $compression = ImagickBackend::COMPRESSION_UNDEFINED;

        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick;
    }

    private function processAvif(ImagickBackend $imagick, int $quality): ImagickBackend
    {
        if (!ImagickBackend::queryFormats('AVIF')) {
            throw new FormatNotSupportedException(
                "AVIF format is not supported by Imagick installation."
            );
        }

        $format = 'avif';
        $compression = ImagickBackend::COMPRESSION_UNDEFINED;

        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);
        $imagick->setCompressionQuality($quality);
        $imagick->setImageCompressionQuality($quality);

        return $imagick;
    }

    private function processHeic(ImagickBackend $imagick, int $quality): ImagickBackend
    {
        if (!ImagickBackend::queryFormats('HEIC')) {
            throw new FormatNotSupportedException(
                "HEIC format is not supported by Imagick installation."
            );
        }

        $format = 'heic';
        $compression = ImagickBackend::COMPRESSION_UNDEFINED;

        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);
        $imagick->setCompressionQuality($quality);
        $imagick->setImageCompressionQuality($quality);

        return $imagick;
    }

    public function clone(Image $image): ImagickBackend
    {
        return clone $image->getCore();
    }

    public function getData(): array
    {
        return [];
    }
}
