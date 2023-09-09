<?php

namespace SergiX44\ImageZen\Alterations;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Rotate extends Alteration implements GdAlteration
{
    public static string $id = 'rotate';

    public function __construct(
        protected int $angle,
        protected Color $background
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $angle = fmod($this->angle, 360);
        $color = $driver->parseColor($this->background);

        $new = imagerotate($image->getCore(), $angle, $color->getInt());

        $this->replaceCore($image, $new);

        return null;
    }
}
