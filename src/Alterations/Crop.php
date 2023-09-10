<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Draws\Size;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Gd\GdCoreResize;
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Shapes\Point;

class Crop extends Alteration implements GdAlteration
{
    use GdCoreResize;

    public static string $id = 'crop';

    public function __construct(
        protected int $width,
        protected int $height,
        protected ?int $x = null,
        protected ?int $y = null,
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $cropped = new Size($this->width, $this->height);

        if ($this->x !== null && $this->y !== null) {
            $position = new Point($this->x, $this->y);
        } else {
            $position = $image->getSize()->align(Position::CENTER)->relativePosition($cropped->align(Position::CENTER));
        }

        $new = $this->coreResize(
            $image->getCore(),
            0,
            0,
            $position->x,
            $position->y,
            $cropped->width,
            $cropped->height,
            $cropped->width,
            $cropped->height
        );

        $this->replaceCore($image, $new);

        return null;
    }
}
