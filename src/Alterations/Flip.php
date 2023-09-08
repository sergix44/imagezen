<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Flip as FlipDraw;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Gd\GdCoreResize;
use SergiX44\ImageZen\Image;

class Flip extends Alteration implements GdAlteration
{
    use GdCoreResize;

    public static string $id = 'flip';

    public function __construct(protected FlipDraw $mode)
    {
    }

    public function applyWithGd(Image $image): null
    {
        $size = $image->getBox();
        $final = clone $size;

        if ($this->mode === FlipDraw::VERTICAL) {
            $size->pivot->y = $size->height - 1;
            $size->height *= -1;
        } else {
            $size->pivot->x = $size->width - 1;
            $size->width *= -1;
        }
        $new = $this->coreResize($image->getCore(), 0, 0, $size->pivot->x, $size->pivot->y, $final->width, $final->height, $size->width, $size->height);
        $this->replaceCore($image, $new);

        return null;
    }
}
