<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Drivers\Driver;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Gd\GdText;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickText;
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Shapes\Rectangle;

abstract class AbstractText extends Alteration implements GdAlteration, ImagickAlteration
{
    public function writeWithGd(Image $image, GdText $text, Driver $driver, int $x, int $y): void
    {
        $color = $driver->parseColor($text->color);
        $box = $text->getBox();

        $opt = [];
        $interlinePixels = 0;
        if ($text->interline !== null) {
            $opt['linespacing'] = $text->interline;
            $interlinePixels = $text->interline * $text->getPointSize();
            $interlinePixels -= $text->getPointSize();
        }

        if ($text->background !== null) {
            $bgY = $y;
            $bgOffset = -4.25 * (1 / 50 * $text->size);
            if ($text->interline !== null) {
                $interlinePixels += $bgOffset;
                $interlinePixels /= 0.65;
            }
            foreach ($text->getMultiLineBoxes() as $lineBox) {
                $image->rectangle(
                    $x + $bgOffset,
                    $bgY - $bgOffset,
                    $x + $lineBox->upperRight->x - $bgOffset,
                    $bgY + $lineBox->upperRight->y + $bgOffset,
                    fn (Rectangle $r) => $r->background($text->background)->border(0)
                );
                $bgY -= $box->upperRight->y - ($text->getPointSize() * 0.72) - $interlinePixels;
            }
        }

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

            if ($text->stroke !== null) {
                $strokeColor = $driver->parseColor($text->strokeColor);
                $stroke = $text->stroke;
                for ($sx = ($x - abs($stroke)); $sx <= ($x + abs($stroke)); $sx++) {
                    for ($sy = ($y - abs($stroke)); $sy <= ($y + abs($stroke)); $sy++) {
                        imagettftext(
                            $image->getCore(),
                            $text->getPointSize(),
                            $text->angle,
                            $sx,
                            $sy,
                            $strokeColor->getInt(),
                            $text->fontPath,
                            $text->parsedText(),
                            $opt
                        );
                    }
                }
            }

            if ($text->hasShadow()) {
                $shadowColor = $driver->parseColor($text->shadowColor);
                imagettftext(
                    $image->getCore(),
                    $text->getPointSize(),
                    $text->angle,
                    $x + $text->shadowX,
                    $y + $text->shadowY,
                    $shadowColor->getInt(),
                    $text->fontPath,
                    $text->parsedText(),
                    $opt
                );
            }

            // enable alphablending for imagettftext
            imagealphablending($image->getCore(), true);

            // draw ttf text
            imagettftext(
                $image->getCore(),
                $text->getPointSize(),
                $text->angle,
                $x,
                $y,
                $color->getInt(),
                $text->fontPath,
                $text->parsedText(),
                $opt
            );

            return;
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

        if ($text->stroke !== null) {
            $strokeColor = $driver->parseColor($text->strokeColor);
            $stroke = $text->stroke;
            for ($sx = ($x - abs($stroke)); $sx <= ($x + abs($stroke)); $sx++) {
                for ($sy = ($y - abs($stroke)); $sy <= ($y + abs($stroke)); $sy++) {
                    imagestring(
                        $image->getCore(),
                        $text->getInternalFont(),
                        $sx,
                        $sy,
                        $text->text,
                        $strokeColor->getInt()
                    );
                }
            }
        }

        if ($text->hasShadow()) {
            $shadowColor = $driver->parseColor($text->shadowColor);
            imagestring(
                $image->getCore(),
                $text->getInternalFont(),
                $x + $text->shadowX,
                $y + $text->shadowY,
                $text->text,
                $shadowColor->getInt()
            );
        }

        // draw text
        imagestring($image->getCore(), $text->getInternalFont(), $x, $y, $text->text, $color->getInt());

    }

    public function writeWithImagick(Image $image, ImagickText $text, Driver $driver, int $x, int $y): void
    {
        $color = $driver->parseColor($text->color);

        $draw = new \ImagickDraw();
        $draw->setTextAntialias(true);
        $draw->setFont($text->fontPath);
        $draw->setFontSize($text->size);
        $draw->setFillColor($color->getPixel());
        $draw->setTextKerning($text->kerning);
        if ($text->interline !== null) {
            $interline = $text->interline * $text->getPointSize();
            $interline -= $text->getPointSize();
            $draw->setTextInterLineSpacing($interline);
        }

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
                $dimensions = $image->getCore()->queryFontMetrics($draw, $text->text);
                $y = $y + $dimensions['textHeight'] * 0.65 / 2;

                break;

            default:
            case Position::BOTTOM:
            case Position::BOTTOM_MIDDLE:
            case Position::BOTTOM_LEFT:
            case Position::BOTTOM_RIGHT:
                $dimensions = $image->getCore()->queryFontMetrics($draw, $text->text);
                $y += $dimensions['characterHeight'];

                break;
        }

        if ($text->background !== null) {
            $draw->setTextUnderColor($driver->parseColor($text->background)->getPixel());
        }

        if ($text->stroke !== null) {
            $draw->setStrokeColor($driver->parseColor($text->strokeColor)->getPixel());
            $draw->setStrokeWidth($text->stroke);
            $draw->setStrokeAntialias(true);
        }

        if ($text->hasShadow()) {
            $draw->setFillColor($driver->parseColor($text->shadowColor)->getPixel());
            $image->getCore()->annotateImage(
                $draw,
                $x + $text->shadowX,
                $y + $text->shadowY,
                $text->angle * (-1),
                $text->text
            );
            $draw->setFillColor($color->getPixel());
        }

        $image->getCore()->annotateImage($draw, $x, $y, $text->angle * (-1), $text->text);
    }
}
