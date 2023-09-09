<?php

namespace SergiX44\ImageZen\Alterations;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Mask extends Alteration implements GdAlteration
{
    public static string $id = 'mask';

    public function __construct(
        protected Image $source,
        protected bool $withAlpha
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $imageBox = $image->getBox();

        // create empty canvas
        $canvas = $image->getDriver()->newImage($imageBox->width, $imageBox->height, Color::rgba(0, 0, 0, 0));

        // build mask image from source
        $mask = $this->source;
        $maskBox = $mask->getBox();

        // resize mask to size of current image (if necessary)
        if (!$maskBox->equals($imageBox)) {
            $mask->resize($imageBox->width, $imageBox->height);
        }

        imagealphablending($canvas, false);

        if (!$this->withAlpha) {
            // mask from greyscale image
            imagefilter($mask->getCore(), IMG_FILTER_GRAYSCALE);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        // redraw old image pixel by pixel considering alpha map
        for ($x = 0; $x < $imageBox->width; $x++) {
            for ($y = 0; $y < $imageBox->height; $y++) {

                $color = $image->pickColor($x, $y);
                $alpha = $mask->pickColor($x, $y);

                if ($this->withAlpha) {
                    $alphaValue = $alpha->alpha; // use alpha channel as mask
                } elseif ($alpha->alpha === 0) {
                    $alphaValue = 0; // transparent as black
                } else {
                    // image is greyscale, so channel doesn't matter (use red channel)
                    $alphaValue = round($alpha->red / 255, 2);
                }

                // preserve alpha of original image...
                if ($color->alpha < $alpha) {
                    $alphaValue = $color->alpha;
                }

                // replace alpha value
                $parsedColor = $driver->parseColor($color);
                $parsedColor->setAlpha($alphaValue);

                // redraw pixel
                imagesetpixel($canvas, $x, $y, $parsedColor->getInt());
            }
        }

        $this->replaceCore($image, $canvas);

        return null;
    }
}
