<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Draws\Size;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Gd\GdEditCore;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Fit extends Alteration implements GdAlteration, ImagickAlteration
{
    use GdEditCore;

    public static string $id = 'fit';

    public function __construct(
        protected int $width,
        protected ?int $height = null,
        protected ?Closure $constraints = null,
        protected Position $position = Position::CENTER,
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        [$cropped, $resized] = $this->calculateSize($image);

        // resize image
        $new = $this->gdEdit(
            $image->getCore(),
            0,
            0,
            $cropped->pivot->x,
            $cropped->pivot->y,
            $resized->getWidth(),
            $resized->getHeight(),
            $cropped->getWidth(),
            $cropped->getHeight()
        );
        $this->replaceCore($image, $new);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        [$cropped, $resized] = $this->calculateSize($image);

        // crop image
        $image->getCore()->cropImage(
            $cropped->width,
            $cropped->height,
            $cropped->pivot->x,
            $cropped->pivot->y
        );

        // resize image
        $image->getCore()->scaleImage($resized->getWidth(), $resized->getHeight());
        $image->getCore()->setImagePage(0, 0, 0, 0);

        return null;
    }

    /**
     * @param Image $image
     * @return array
     */
    public function calculateSize(Image $image): array
    {
        $this->height ??= $this->width;

        // calculate size
        $cropped = $image->getSize()->fit(new Size($this->width, $this->height), $this->position);
        $resized = clone $cropped;
        $resized = $resized->resize($this->width, $this->height, $this->constraints);

        return [$cropped, $resized];
    }
}
