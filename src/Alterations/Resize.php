<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Gd\GdEditCore;
use SergiX44\ImageZen\Image;

class Resize extends Alteration implements GdAlteration
{
    use GdEditCore;

    public static string $id = 'resize';

    public function __construct(
        protected ?int $width,
        protected ?int $height,
        protected ?Closure $constraints = null
    ) {
    }

    public function applyWithGd(Image $image): null
    {

        $resized = $image->getSize()->resize(
            $this->width,
            $this->height,
            $this->constraints
        );

        $new = $this->gdEdit(
            $image->getCore(),
            0,
            0,
            0,
            0,
            $resized->getWidth(),
            $resized->getHeight(),
            $image->width(),
            $image->height()
        );

        $this->replaceCore($image, $new);

        return null;
    }
}
