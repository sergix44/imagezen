<?php

namespace SergiX44\ImageZen\Alterations;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class LimitColors extends Alteration implements GdAlteration
{
    public static string $id = 'limitColors';

    public function __construct(
        protected int $count,
        protected ?Color $matte = null,
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $box = $image->getBox();

        // create empty canvas
        $resource = imagecreatetruecolor($box->width, $box->height);

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
        imagecopy($resource, $image->getCore(), 0, 0, 0, 0, $box->width, $box->height);

        if ($this->count <= 256) {
            // decrease colors
            imagetruecolortopalette($resource, true, $this->count);
        }

        $this->replaceCore($image, $resource);

        return null;
    }
}
