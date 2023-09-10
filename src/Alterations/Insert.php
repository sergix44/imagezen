<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Insert extends Alteration implements GdAlteration
{
    public static string $id = 'insert';

    public function __construct(
        protected Image $source,
        protected Position $position,
        protected ?int $x = null,
        protected ?int $y = null
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        // define insertion point
        $imageSize = $image->getSize()->align($this->position, $this->x, $this->y);
        $sourceSize = $this->source->getSize()->align($this->position);
        $target = $imageSize->relativePosition($sourceSize);

        // insert image at position
        imagealphablending($image->getCore(), true);
        imagecopy($image->getCore(), $this->source->getCore(), $target->x, $target->y, 0, 0, $sourceSize->width, $sourceSize->height);

        return null;
    }
}
