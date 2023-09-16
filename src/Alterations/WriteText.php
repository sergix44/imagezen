<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Gd\GdText;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickText;
use SergiX44\ImageZen\Image;

class WriteText extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'text';

    public function __construct(
        protected string $text,
        protected int $x,
        protected int $y,
        protected ?Closure $callback = null
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $text = new GdText($this->text);
        if ($this->callback instanceof Closure) {
            $this->callback->call($this, $text);
        }

        $x = $this->x;
        $y = $this->y;

        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $color = $driver->parseColor($text->color);
        $box = $text->getBox();
        if ($text->hasFont()) {
            if ($text->angle !== 0 || $text->align !== Position::TOP_LEFT) {
                switch ($text->align) {
                    case Position::TOP:
                    case Position::TOP_MIDDLE:
                        $x -= round(($box->upperLeft->x + $box->upperRight->x) / 2);
                        $y -= round(($box->upperLeft->y + $box->upperRight->y) / 2);

                        break;
                    case Position::RIGHT:
                    case Position::TOP_RIGHT:
                        $x -= $box->upperRight->x;
                        $y -= $box->upperRight->y;

                        break;
                    case Position::LEFT:
                    case Position::TOP_LEFT:
                        $x -= $box->upperLeft->x;
                        $y -= $box->upperLeft->y;

                        break;
                    case Position::CENTER_MIDDLE:
                    case Position::CENTER:
                        $x -= round(($box->lowerLeft->x + $box->upperRight->x) / 2);
                        $y -= round(($box->lowerLeft->y + $box->upperRight->y) / 2);

                        break;
                    case Position::CENTER_RIGHT:
                        $x -= round(($box->lowerRight->x + $box->upperRight->x) / 2);
                        $y -= round(($box->lowerRight->y + $box->upperRight->y) / 2);

                        break;

                    case Position::CENTER_LEFT:
                        $x -= round(($box->lowerLeft->x + $box->upperLeft->x) / 2);
                        $y -= round(($box->lowerLeft->y + $box->upperLeft->y) / 2);

                        break;
                    case Position::BOTTOM:
                    case Position::BOTTOM_MIDDLE:
                        $x -= round(($box->lowerLeft->x + $box->lowerRight->x) / 2);
                        $y -= round(($box->lowerLeft->y + $box->lowerRight->y) / 2);

                        break;
                    case Position::BOTTOM_RIGHT:
                        $x -= $box->lowerRight->x;
                        $y -= $box->lowerRight->y;

                        break;
                    case Position::BOTTOM_LEFT:
                        $x -= $box->lowerLeft->x;
                        $y -= $box->lowerLeft->y;

                        break;
                }
            }

            // enable alphablending for imagettftext
            imagealphablending($image->getCore(), true);

            // draw ttf text
            imagettftext($image->getCore(), $text->getPointSize(), $text->angle, $x, $y, $color->getInt(), $text->fontPath, $text->parsedText());

            return null;
        }

        // get box size
        $size = $box->getSize();
        $width = $size->width;
        $height = $size->height;

        // internal font specific position corrections
        if ($text->getInternalFont() === 1) {
            $topFix = 1;
            $bottomFix = 2;
        } elseif ($text->getInternalFont() === 3) {
            $topFix = 2;
            $bottomFix = 4;
        } else {
            $topFix = 3;
            $bottomFix = 4;
        }

        // x-position corrections for horizontal alignment
        switch ($text->align) {
            case Position::CENTER:
            case Position::CENTER_MIDDLE:
            case Position::TOP_MIDDLE:
            case Position::BOTTOM_MIDDLE:
                $x = ceil($x - ($width / 2));

                break;

            case Position::RIGHT:
            case Position::CENTER_RIGHT:
            case Position::TOP_RIGHT:
            case Position::BOTTOM_RIGHT:
                $x = ceil($x - $width) + 1;

                break;
        }

        // y-position corrections for vertical alignment
        switch ($text->align) {
            case Position::CENTER:
            case Position::CENTER_MIDDLE:
            case Position::CENTER_LEFT:
            case Position::CENTER_RIGHT:
                $y = ceil($y - ($height / 2));

                break;

            case Position::TOP:
            case Position::TOP_MIDDLE:
            case Position::TOP_LEFT:
            case Position::TOP_RIGHT:
                $y = ceil($y - $topFix);

                break;

            default:
            case Position::BOTTOM:
            case Position::BOTTOM_MIDDLE:
            case Position::BOTTOM_LEFT:
            case Position::BOTTOM_RIGHT:
                $y = round($y - $height + $bottomFix);

                break;
        }

        // draw text
        imagestring($image->getCore(), $text->getInternalFont(), $x, $y, $this->text, $color->getInt());

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $text = new ImagickText($this->text);
        if ($this->callback instanceof Closure) {
            $this->callback->call($this, $text);
        }

        $x = $this->x;
        $y = $this->y;

        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $color = $driver->parseColor($text->color);

        $draw = new \ImagickDraw();
        $draw->setStrokeAntialias(true);
        $draw->setTextAntialias(true);
        $draw->setFont($text->fontPath);
        $draw->setFontSize($text->size);
        $draw->setFillColor($color->getPixel());
        $draw->setTextKerning($text->kerning);

        switch ($text->align) {
            case Position::CENTER:
            case Position::CENTER_MIDDLE:
            case Position::TOP_MIDDLE:
            case Position::BOTTOM_MIDDLE:
                $align = \Imagick::ALIGN_CENTER;

                break;

            case Position::RIGHT:
            case Position::CENTER_RIGHT:
            case Position::TOP_RIGHT:
            case Position::BOTTOM_RIGHT:
                $align = \Imagick::ALIGN_RIGHT;

                break;
            default:
            case Position::LEFT:
            case Position::CENTER_LEFT:
            case Position::TOP_LEFT:
            case Position::BOTTOM_LEFT:
                $align = \Imagick::ALIGN_LEFT;

                break;
        }

        $draw->setTextAlignment($align);

        switch ($text->align) {
            case Position::CENTER:
            case Position::CENTER_MIDDLE:
            case Position::CENTER_LEFT:
            case Position::CENTER_RIGHT:
            case Position::TOP:
            case Position::TOP_MIDDLE:
            case Position::TOP_LEFT:
            case Position::TOP_RIGHT:
                $dimensions = $image->getCore()->queryFontMetrics($draw, $this->text);
                $y = $y + $dimensions['textHeight'] * 0.65 / 2;

                break;

            default:
            case Position::BOTTOM:
            case Position::BOTTOM_MIDDLE:
            case Position::BOTTOM_LEFT:
            case Position::BOTTOM_RIGHT:
                $dimensions = $image->getCore()->queryFontMetrics($draw, $this->text, false);
                $y += $dimensions['characterHeight'];

                break;
        }

        $image->getCore()->annotateImage($draw, $x, $y, $text->angle * (-1), $this->text);

        return null;
    }
}
