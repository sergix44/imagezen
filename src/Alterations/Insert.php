<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Insert extends Alteration implements GdAlteration, ImagickAlteration
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

    public function applyWithImagick(Image $image): null
    {
        $image_size = $image->getSize()->align($this->position, $this->x, $this->y);
        $sourceSize = $this->source->getSize()->align($this->position);
        $target = $image_size->relativePosition($sourceSize);
        $image->getCore()->compositeImage($this->source->getCore(), \Imagick::COMPOSITE_DEFAULT, $target->x, $target->y);

        return null;
    }
}
