<?php

namespace SergiX44\ImageZen\Alterations;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Draws\TrimFrom;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Gd\GdEditCore;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class Trim extends Alteration implements GdAlteration, ImagickAlteration
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
        [$size, $transparency, $color] = $this->getParams($image);

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

    public function applyWithImagick(Image $image): null
    {
        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        [$size, $transparency, $color] = $this->getParams($image);

        $trimmed = clone $image->getCore();

        // add border to trim specific color
        $trimmed->borderImage($driver->parseColor($color)->getPixel(), 1, 1);

        // trim image
        $trimmed->trimImage(65850 / 100 * $this->tolerance);

        // get coordinates of trim
        $imagePage = $trimmed->getImagePage();
        [$cropX, $cropY] = [$imagePage['x'] - 1, $imagePage['y'] - 1];
        [$cropW, $cropH] = [$trimmed->getImageWidth(), $trimmed->getImageHeight()];

        if (!in_array(Position::RIGHT, $this->borders, true)) {
            $cropW += ($size->width - ($size->width - $cropX));
        }

        if (!in_array(Position::BOTTOM, $this->borders, true)) {
            $cropH += ($size->height - ($size->height - $cropY));
        }

        if (!in_array(Position::LEFT, $this->borders, true)) {
            $cropW += $cropX;
            $cropX = 0;
        }

        if (!in_array(Position::TOP, $this->borders, true)) {
            $cropH += $cropY;
            $cropY = 0;
        }

        // add feather
        $cropW = min($size->width, ($cropW + $this->feather * 2));
        $cropH = min($size->height, ($cropH + $this->feather * 2));
        $cropX = max(0, ($cropX - $this->feather));
        $cropY = max(0, ($cropY - $this->feather));

        // finally crop based on page
        $image->getCore()->cropImage($cropW, $cropH, $cropX, $cropY);
        $image->getCore()->setImagePage(0, 0, 0, 0);

        $trimmed->destroy();

        return null;
    }

    /**
     * @param  Image  $image
     * @return array
     */
    public function getParams(Image $image): array
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

        return [$size, $transparency, $color];
    }
}
