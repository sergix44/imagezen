<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Size;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Mask extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'mask';

    public function __construct(
        protected Image $source,
        protected bool $withAlpha
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $size = $image->getSize();
        $canvas = $image->getDriver()->newImage($size->width, $size->height, Color::transparent());
        $mask = $this->getMask($size);

        imagealphablending($canvas, false);

        if (!$this->withAlpha) {
            // mask from greyscale image
            imagefilter($mask->getCore(), IMG_FILTER_GRAYSCALE);
        }

        // Perform pixel-based alpha map application
        for ($x = 0; $x < $size->width; $x++) {
            for ($y = 0; $y < $size->height; $y++) {
                $alpha = imagecolorsforindex($mask->getCore(), imagecolorat($mask->getCore(), $x, $y));
                $color = imagecolorsforindex($image->getCore(), imagecolorat($image->getCore(), $x, $y));

                if ($this->withAlpha) {
                    $alpha = $alpha['alpha'];
                } else {
                    $alpha = 127 - floor($alpha['red'] / 2);
                }

                if ($color['alpha'] > $alpha) {
                    $alpha = $color['alpha'];
                }

                if ($alpha === 127) {
                    $color['red'] = 0;
                    $color['blue'] = 0;
                    $color['green'] = 0;
                }

                imagesetpixel($canvas, $x, $y, imagecolorallocatealpha($canvas, $color['red'], $color['green'], $color['blue'], $alpha));
            }
        }

        $this->replaceCore($image, $canvas);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $mask = $this->getMask($image->getSize());

        $image->getCore()->setImageMatte(true);

        if ($this->withAlpha) {
            $image->getCore()->compositeImage($mask->getCore(), \Imagick::COMPOSITE_DSTIN, 0, 0);

            return null;
        }

        // get alpha channel of original as greyscale image
        $original = $image->getCore()->clone();
        $original->separateImageChannel(\Imagick::CHANNEL_ALPHA);

        // use red channel from mask ask alpha
        $maskAlpha = $mask->getCore()->clone();
        $maskAlpha->compositeImage($mask->getCore(), \Imagick::COMPOSITE_DEFAULT, 0, 0);
        $maskAlpha->separateImageChannel(\Imagick::CHANNEL_ALL);

        // combine both alphas from original and mask
        $original->compositeImage($maskAlpha, \Imagick::COMPOSITE_COPYOPACITY, 0, 0);

        // mask the image with the alpha combination
        $image->getCore()->compositeImage($original, \Imagick::COMPOSITE_DSTIN, 0, 0);

        return null;
    }

    /**
     * @param  Size  $size
     * @return Image
     */
    private function getMask(Size $size): Image
    {
        // build mask image from source
        $mask = $this->source;
        $maskSize = $mask->getSize();

        // resize mask to size of current image (if necessary)
        if (!$maskSize->equals($size)) {
            $mask->resize($size->width, $size->height);
        }

        return $mask;
    }
}
