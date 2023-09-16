<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use Intervention\Image\Imagick\Color;
use InvalidArgumentException;
use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Shapes\Polygon;

class PolygonShape extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'polygon';

    public function __construct(
        protected array $points,
        protected ?Closure $callback = null
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $verticesCount = count($this->points);

        // check if number if coordinates is even
        if ($verticesCount % 2 !== 0) {
            throw new InvalidArgumentException(
                "The number of given polygon vertices must be even."
            );
        }

        if ($verticesCount < 6) {
            throw new InvalidArgumentException(
                "You must have at least 3 points in your array."
            );
        }

        $polygon = new Polygon();
        if ($this->callback instanceof Closure) {
            $this->callback->call($this, $polygon);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }
        $background = $driver->parseColor($polygon->getBackground());

        imagefilledpolygon($image->getCore(), $this->points, (int) (count($this->points) / 2), $background->getInt());

        if ($polygon->hasBorder()) {
            $color = $driver->parseColor($polygon->getBorderColor());
            imagesetthickness($image->getCore(), $polygon->getBorderWidth());
            imagepolygon($image->getCore(), $this->points, (int) (count($this->points) / 2), $color->getInt());
        }

        return null;
    }

    public function applyWithImagick(Image $image): mixed
    {
        $polygon = new Polygon();
        if ($this->callback instanceof Closure) {
            $this->callback->call($this, $polygon);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }
        $background = $driver->parseColor($polygon->getBackground());

        $draw = new \ImagickDraw();
        $draw->setFillColor($background->getPixel());

        if ($polygon->hasBorder()) {
            $draw->setStrokeWidth($polygon->getBorderWidth());
            $draw->setStrokeColor($driver->parseColor($polygon->getBorderColor())->getPixel());
        }

        $coordinates = [];
        $count = count($this->points);
        for ($i = 0; $i < $count; $i += 2) {
            $coordinates[] = ['x' => $this->points[$i], 'y' => $this->points[$i + 1]];
        }

        $draw->polygon($coordinates);

        $image->getCore()->drawImage($draw);

        return null;
    }
}
