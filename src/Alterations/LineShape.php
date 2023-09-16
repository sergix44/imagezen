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
use SergiX44\ImageZen\Shapes\Line;

class LineShape extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'line';

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
        $line = new Line();
        if ($this->callback instanceof Closure) {
            $this->callback->call($this, $line);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        imageline($image->getCore(), $this->x1, $this->y1, $this->x2, $this->y2, $driver->parseColor($line->getBorderColor())->getInt());

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $line = new Line();
        if ($this->callback instanceof Closure) {
            $this->callback->call($this, $line);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }
        $background = $driver->parseColor($line->getBorderColor());

        $draw = new \ImagickDraw();
        $draw->setStrokeColor($background->getPixel());
        $draw->setStrokeWidth($line->getBorderWidth());
        $draw->line($this->x1, $this->y1, $this->x2, $this->y2);
        $image->getCore()->drawImage($draw);

        return null;
    }
}
