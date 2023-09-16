<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Draws\Size;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class ResizeCanvas extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'resizeCanvas';

    public function __construct(
        public ?int $width,
        public ?int $height,
        public Position $anchor,
        public bool $relative,
        public Color $background,
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        [$canvas, $endX, $startX, $startWidth, $endY, $startY, $startHeight] = $this->getCanvas($image);

        // make image area transparent to keep transparency
        // even if background-color is set
        $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
        imagealphablending($canvas, false); // do not blend / just overwrite
        imagefilledrectangle($canvas, $endX, $endY, $endX + $startWidth - 1, $endY + $startHeight - 1, $transparent);

        // copy image into new canvas
        imagecopy($canvas, $image->getCore(), $endX, $endY, $startX, $startY, $startWidth, $startHeight);

        // set new core to canvas
        $this->replaceCore($image, $canvas);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        [$canvas, $endX, $startX, $startWidth, $endY, $startY, $startHeight] = $this->getCanvas($image);

        $rect = new \ImagickDraw();
        $fill = $image->pickColor(0, 0)->toHex();
        $rect->setFillColor(new \ImagickPixel($fill === '#ff0000' ? '#00ff00' : '#ff0000'));
        $rect->rectangle($endX, $endY, $endX + $startWidth - 1, $endY + $startHeight - 1);
        $canvas->drawImage($rect);
        $canvas->transparentPaintImage($fill, 0, 0, false);
        $canvas->setImageColorspace($image->getCore()->getImageColorspace());

        // copy image into new canvas
        $image->getCore()->cropImage($startWidth, $startHeight, $startX, $startY);
        $canvas->compositeImage($image->getCore(), \Imagick::COMPOSITE_DEFAULT, $endX, $endY);
        $canvas->setImagePage(0, 0, 0, 0);

        $this->replaceCore($image, $canvas);

        return null;
    }

    /**
     * @param  Image  $image
     * @return array
     */
    protected function getCanvas(Image $image): array
    {
        $size = $image->getSize();
        $originalWidth = $size->width;
        $originalHeight = $size->height;

        // check of only width or height is set
        $width = $this->width ?? $originalWidth;
        $height = $this->height ?? $originalHeight;

        // check on relative width/height
        if ($this->relative) {
            $width = $originalWidth + $width;
            $height = $originalHeight + $height;
        }

        // check for negative width/height
        $width = ($width <= 0) ? $width + $originalWidth : $width;
        $height = ($height <= 0) ? $height + $originalHeight : $height;

        // create new canvas
        $canvas = $image->getDriver()->newImage($width, $height, $this->background);
        $canvasSize = new Size($width, $height);

        // set copy position
        $canvasSize = $canvasSize->align($this->anchor);
        $imageSize = $size->align($this->anchor);
        $canvasPosition = $imageSize->relativePosition($canvasSize);
        $imagePosition = $canvasSize->relativePosition($imageSize);

        if ($width <= $originalWidth) {
            $endX = 0;
            $startX = $canvasPosition->x;
            $startWidth = $canvasSize->width;
        } else {
            $endX = $imagePosition->x;
            $startX = 0;
            $startWidth = $originalWidth;
        }

        if ($height <= $originalHeight) {
            $endY = 0;
            $startY = $canvasPosition->y;
            $startHeight = $canvasSize->height;
        } else {
            $endY = $imagePosition->y;
            $startY = 0;
            $startHeight = $originalHeight;
        }

        return [$canvas, $endX, $startX, $startWidth, $endY, $startY, $startHeight];
    }
}
