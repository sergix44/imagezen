<?php

namespace SergiX44\ImageZen\Alterations;

use InvalidArgumentException;
use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Fill extends Alteration implements GdAlteration
{
    public static string $id = 'fill';

    protected ?Color $color = null;
    protected ?Image $tile = null;
    protected ?int $x = null;
    protected ?int $y = null;

    public function __construct(Image|Color $input, int $x = null, int $y = null)
    {
        $this->x = $x;
        $this->y = $y;
        if ($input instanceof Image) {
            $this->tile = $input;
        } else {
            $this->color = $input;
        }
    }

    public function applyWithGd(Image $image): null
    {
        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        if ($this->tile !== null) {
            if ($this->tile->getDriver()::class !== $driver::class) {
                throw new InvalidArgumentException('The tile image must use the same driver as the main image.');
            }

            imagesettile($image->getCore(), $this->tile->getCore());
            $filling = IMG_COLOR_TILED;
        } else {
            $filling = $driver->parseColor($this->color)->getInt();
        }

        $width = $image->width();
        $height = $image->height();
        $resource = $image->getCore();

        imagealphablending($resource, true);

        if ($this->x !== null && $this->y !== null) {
            // resource should be visible through transparency
            $base = $image->getDriver()->newImage($width, $height, Color::transparent());
            imagecopy($base, $resource, 0, 0, 0, 0, $width, $height);

            // floodfill if exact position is defined
            imagefill($resource, $this->x, $this->y, $filling);

            // copy filled original over base
            imagecopy($base, $resource, 0, 0, 0, 0, $width, $height);

            // set base as new resource-core
            $this->replaceCore($image, $base);
        } else {
            // fill whole image otherwise
            imagefilledrectangle($resource, 0, 0, $width - 1, $height - 1, $filling);
        }

        return null;
    }
}
