<?php

namespace SergiX44\ImageZen\Alterations;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class LimitColors extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'limitColors';

    public function __construct(
        protected int $count,
        protected ?Color $matte = null,
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $size = $image->getSize();

        // create empty canvas
        $resource = imagecreatetruecolor($size->width, $size->height);

        // define matte
        if ($this->matte === null) {
            $matte = imagecolorallocatealpha($resource, 255, 255, 255, 127);
        } else {
            $driver = $image->getDriver();
            if (!($driver instanceof Gd)) {
                throw new RuntimeException('Invalid driver for this alteration');
            }
            $matte = $driver->parseColor($this->matte)->getInt();
        }

        // fill with matte and copy original image
        imagefill($resource, 0, 0, $matte);

        // set transparency
        imagecolortransparent($resource, $matte);

        // copy original image
        imagecopy($resource, $image->getCore(), 0, 0, 0, 0, $size->width, $size->height);

        if ($this->count <= 256) {
            // decrease colors
            imagetruecolortopalette($resource, true, $this->count);
        }

        $this->replaceCore($image, $resource);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $size = $image->getSize();

        // build 2 color alpha mask from original alpha
        $alpha = $image->getCore()->clone();
        $alpha->separateImageChannel(\Imagick::CHANNEL_ALPHA);
        $alpha->transparentPaintImage('#ffffff', 0, 0, false);
        $alpha->separateImageChannel(\Imagick::CHANNEL_ALPHA);
        $alpha->negateImage(false);

        if ($this->matte === null) {
            $image->getCore()->quantizeImage($this->count, \Imagick::COLORSPACE_RGB, 0, false, false);
            $image->getCore()->compositeImage($alpha, \Imagick::COMPOSITE_COPYOPACITY, 0, 0);

            return null;
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }
        $matte = $driver->parseColor($this->matte)->getPixel();

        // create matte image
        $canvas = new \Imagick();
        $canvas->newImage($size->width, $size->height, $matte, 'png');

        // lower colors of original and copy to matte
        $image->getCore()->quantizeImage($this->count, \Imagick::COLORSPACE_RGB, 0, false, false);
        $canvas->compositeImage($image->getCore(), \Imagick::COMPOSITE_DEFAULT, 0, 0);

        // copy new alpha to canvas
        $canvas->compositeImage($alpha, \Imagick::COMPOSITE_COPYOPACITY, 0, 0);

        // replace core
        $this->replaceCore($image, $canvas);

        return null;
    }
}
