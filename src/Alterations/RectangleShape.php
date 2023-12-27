<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Shapes\Rectangle;

class RectangleShape extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'rectangle';

    public function __construct(
        protected int $x1,
        protected int $y1,
        protected int $x2,
        protected int $y2,
        protected ?Closure $callback = null,
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $rectangle = new Rectangle();
        if ($this->callback instanceof Closure) {
            call_user_func($this->callback, $rectangle);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }
        $background = $driver->parseColor($rectangle->getBackground());

        imagefilledrectangle($image->getCore(), $this->x1, $this->y1, $this->x2, $this->y2, $background->getInt());

        if ($rectangle->hasBorder()) {
            $color = $driver->parseColor($rectangle->getBorderColor());
            imagesetthickness($image->getCore(), $rectangle->getBorderWidth());
            imagerectangle($image->getCore(), $this->x1, $this->y1, $this->x2, $this->y2, $color->getInt());
        }

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $rectangle = new Rectangle();
        if ($this->callback instanceof Closure) {
            call_user_func($this->callback, $rectangle);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }
        $background = $driver->parseColor($rectangle->getBackground());

        $draw = new \ImagickDraw();
        $draw->setFillColor($background->getPixel());

        if ($rectangle->hasBorder()) {
            $draw->setStrokeWidth($rectangle->getBorderWidth());
            $draw->setStrokeColor($driver->parseColor($rectangle->getBorderColor())->getPixel());
        }

        $draw->rectangle($this->x1, $this->y1, $this->x2, $this->y2);

        $image->getCore()->drawImage($draw);

        return null;
    }
}
