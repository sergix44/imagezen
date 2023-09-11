<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Draws\TrimFrom;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Gd\GdEditCore;
use SergiX44\ImageZen\Image;

class Trim extends Alteration implements GdAlteration
{
    use GdEditCore;

    public static string $id = 'trim';

    protected TrimFrom $base;
    /**
     * @var Position[]
     */
    protected array $borders;
    protected int $tolerance;
    protected int $feather;

    public function __construct(TrimFrom $base, array $borders, int $tolerance, int $feather)
    {
        $this->base = $base;
        $this->borders = $borders;
        $this->tolerance = $tolerance;
        $this->feather = $feather;
    }

    public function applyWithGd(Image $image): null
    {
        $size = $image->getSize();
        $x = 0;
        $y = 0;
        $transparency = false;

        // define base color position
        switch ($this->base) {
            case TrimFrom::TRANSPARENT:
                $transparency = true;

                break;

            case TrimFrom::BOTTOM_RIGHT:
                $x = $size->width - 1;
                $y = $size->height - 1;

                break;

            case TrimFrom::TOP_LEFT:
                break;
        }

        // pick base color
        $color = $transparency ? Color::transparent() : $image->pickColor($x, $y);

        $topX = 0;
        $topY = 0;
        $bottomX = $size->width;
        $bottomY = $size->height;

        // search upper part of image for colors to trim away
        if (in_array(Position::TOP, $this->borders, true)) {

            for ($y = 0; $y < ceil($size->height / 2); $y++) {
                for ($x = 0; $x < $size->width; $x++) {

                    $checkColor = $image->pickColor($x, $y);

                    if ($transparency) {
                        $checkColor->red = $color->red;
                        $checkColor->green = $color->green;
                        $checkColor->blue = $color->blue;
                    }

                    if ($color->differs($checkColor, $this->tolerance)) {
                        $topY = max(0, $y - $this->feather);

                        break 2;
                    }

                }
            }

        }

        // search left part of image for colors to trim away
        if (in_array(Position::LEFT, $this->borders, true)) {
            for ($x = 0; $x < ceil($size->width / 2); $x++) {
                for ($y = $topY; $y < $size->height; $y++) {

                    $checkColor = $image->pickColor($x, $y);

                    if ($transparency) {
                        $checkColor->red = $color->red;
                        $checkColor->green = $color->green;
                        $checkColor->blue = $color->blue;
                    }

                    if ($color->differs($checkColor, $this->tolerance)) {
                        $topX = max(0, $x - $this->feather);

                        break 2;
                    }

                }
            }

        }

        // search lower part of image for colors to trim away
        if (in_array(Position::BOTTOM, $this->borders, true)) {

            for ($y = ($size->height - 1); $y >= floor($size->height / 2) - 1; $y--) {
                for ($x = $topX; $x < $size->width; $x++) {

                    $checkColor = $image->pickColor($x, $y);

                    if ($transparency) {
                        $checkColor->red = $color->red;
                        $checkColor->green = $color->green;
                        $checkColor->blue = $color->blue;
                    }

                    if ($color->differs($checkColor, $this->tolerance)) {
                        $bottomY = min($size->height, $y + 1 + $this->feather);

                        break 2;
                    }

                }
            }

        }

        // search right part of image for colors to trim away
        if (in_array(Position::RIGHT, $this->borders, true)) {

            for ($x = ($size->width - 1); $x >= floor($size->width / 2) - 1; $x--) {
                for ($y = $topY; $y < $bottomY; $y++) {

                    $checkColor = $image->pickColor($x, $y);

                    if ($transparency) {
                        $checkColor->red = $color->red;
                        $checkColor->green = $color->green;
                        $checkColor->blue = $color->blue;
                    }

                    if ($color->differs($checkColor, $this->tolerance)) {
                        $bottomX = min($size->width, $x + 1 + $this->feather);

                        break 2;
                    }
                }
            }
        }

        $new = $this->gdEdit($image->getCore(), 0, 0, $topX, $topY, ($bottomX - $topX), ($bottomY - $topY), ($bottomX - $topX), ($bottomY - $topY));
        $this->replaceCore($image, $new);

        return null;
    }
}
