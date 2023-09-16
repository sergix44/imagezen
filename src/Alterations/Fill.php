<?php

namespace SergiX44\ImageZen\Alterations;

use InvalidArgumentException;
use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Format;
use SergiX44\ImageZen\Image;

class Fill extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'fill';

    protected ?Color $color = null;
    protected ?Image $tile = null;
    protected ?int $x = null;
    protected ?int $y = null;

    public function __construct(Image|Color $input, int $x = null, int $y = null)
    {
        $this->x = $x;
        $this->y = $y;
        if ($input instanceof Image) {
            $this->tile = $input;
        } else {
            $this->color = $input;
        }
    }

    public function applyWithGd(Image $image): null
    {
        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        if ($this->tile !== null) {
            if ($this->tile->getDriver()::class !== $driver::class) {
                throw new InvalidArgumentException('The tile image must use the same driver as the main image.');
            }

            imagesettile($image->getCore(), $this->tile->getCore());
            $filling = IMG_COLOR_TILED;
        } else {
            $filling = $driver->parseColor($this->color)->getInt();
        }

        $width = $image->width();
        $height = $image->height();
        $resource = $image->getCore();

        imagealphablending($resource, true);

        if ($this->x !== null && $this->y !== null) {
            // resource should be visible through transparency
            $base = $image->getDriver()->newImage($width, $height, Color::transparent());
            imagecopy($base, $resource, 0, 0, 0, 0, $width, $height);

            // floodfill if exact position is defined
            imagefill($resource, $this->x, $this->y, $filling);

            // copy filled original over base
            imagecopy($base, $resource, 0, 0, 0, 0, $width, $height);

            // set base as new resource-core
            $this->replaceCore($image, $base);
        } else {
            // fill whole image otherwise
            imagefilledrectangle($resource, 0, 0, $width - 1, $height - 1, $filling);
        }

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        // flood fill if coordinates are set
        if ($this->x !== null && $this->y !== null) {
            // flood fill with texture
            if ($this->tile !== null) {
                // create tile
                $tile = $image->getCore()->clone();

                // mask away color at position
                $tile->transparentPaintImage($tile->getImagePixelColor($this->x, $this->y), 0, 0, false);

                // create canvas
                $canvas = $image->getCore()->clone();

                // fill canvas with texture
                $canvas = $canvas->textureImage($this->tile->getCore());

                // merge canvas and tile
                $canvas->compositeImage($tile, \Imagick::COMPOSITE_DEFAULT, 0, 0);

                // replace image core
                $this->replaceCore($image, $canvas);
                // flood fill with color
            } elseif ($this->color !== null) {
                // create canvas with filling
                $canvas = new \Imagick();

                $canvas->newImage(
                    $image->width(),
                    $image->height(),
                    $driver->parseColor($this->color)->getPixel(),
                    Format::PNG->name()
                );

                // create tile to put on top
                $tile = $image->getCore()->clone();

                // mask away color at pos.
                $tile->transparentPaintImage($tile->getImagePixelColor($this->x, $this->y), 0, 0, false);

                // save alpha channel of original image
                $alpha = $image->getCore()->clone();

                // merge original with canvas and tile
                $image->getCore()->compositeImage($canvas, \Imagick::COMPOSITE_DEFAULT, 0, 0);
                $image->getCore()->compositeImage($tile, \Imagick::COMPOSITE_DEFAULT, 0, 0);

                // restore alpha channel of original image
                $image->getCore()->compositeImage($alpha, \Imagick::COMPOSITE_COPYOPACITY, 0, 0);
            }
        } else {
            if ($this->tile !== null) {
                // fill whole image with texture
                $this->replaceCore($image, $image->getCore()->textureImage($this->tile->getCore()));
            } elseif ($this->color !== null) {
                // fill whole image with color
                $draw = new \ImagickDraw();
                $draw->setFillColor($driver->parseColor($this->color)->getPixel());
                $draw->rectangle(0, 0, $image->width(), $image->height());
                $image->getCore()->drawImage($draw);
            }
        }

        return null;
    }
}
