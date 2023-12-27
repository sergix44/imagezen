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
use SergiX44\ImageZen\Shapes\Ellipse;
use SergiX44\ImageZen\Shapes\Shape;

class EllipseShape extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'ellipse';

    public static string $shape = Ellipse::class;

    private int $width;
    private int $height;
    private int $x;
    private int $y;
    private ?Closure $callback;

    public function __construct(int $width, int $height, int $x, int $y, Closure $callback = null)
    {
        $this->width = $width;
        $this->height = $height;
        $this->x = $x;
        $this->y = $y;
        $this->callback = $callback;
    }

    private function getShape(): Shape
    {
        $shape = new static::$shape();
        if ($this->callback instanceof Closure) {
            call_user_func($this->callback, $shape);
        }

        return $shape;
    }

    public function applyWithGd(Image $image): null
    {
        $shape = $this->getShape();

        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        // parse background color
        $background = $driver->parseColor($shape->getBackground());

        if ($shape->hasBorder()) {
            imagefilledellipse($image->getCore(), $this->x, $this->y, $this->width - 1, $this->height - 1, $background->getInt());

            imagesetthickness($image->getCore(), $shape->getBorderWidth());

            $borderColor = $driver->parseColor($shape->getBorderColor());
            imagearc($image->getCore(), $this->x, $this->y, $this->width, $this->height, 0, 360, $borderColor->getInt());
        } else {
            imagefilledellipse($image->getCore(), $this->x, $this->y, $this->width, $this->height, $background->getInt());
        }

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $shape = $this->getShape();

        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $circle = new \ImagickDraw();
        $circle->setFillColor($driver->parseColor($shape->getBackground())->getPixel());

        // set border
        if ($shape->hasBorder()) {
            $circle->setStrokeWidth($shape->getBorderWidth());
            $circle->setStrokeColor($driver->parseColor($shape->getBorderColor())->getPixel());
        }

        $circle->ellipse($this->x, $this->y, $this->width / 2, $this->height / 2, 0, 360);

        $image->getCore()->drawImage($circle);

        return null;
    }
}
