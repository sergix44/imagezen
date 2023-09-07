<?php

namespace SergiX44\ImageZen\Drivers\Imagick;

use ImagickPixel;
use SergiX44\ImageZen\Drivers\ColorDialect;

class ImagickColor extends ColorDialect
{

    public function getPixel(): ImagickPixel
    {
        return new ImagickPixel(sprintf('rgba(%d, %d, %d, %f)', $this->color->red, $this->color->green, $this->color->blue, $this->color->alpha));
    }

}
