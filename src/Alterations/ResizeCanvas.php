<?php

namespace SergiX44\ImageZen\Alterations;

use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Draws\Box;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class ResizeCanvas extends Alteration implements GdAlteration
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
        $originalBox = $image->getBox();
        $originalWidth = $originalBox->width;
        $originalHeight = $originalBox->height;

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
        $canvasBox = new Box($width, $height);

        // set copy position
        $canvasSize = $canvasBox->align($this->anchor);
        $imageSize = $originalBox->align($this->anchor);
        $canvasPosition = $imageSize->relativePosition($canvasSize);
        $imagePosition = $canvasSize->relativePosition($imageSize);

        if ($width <= $originalWidth) {
            $dst_x = 0;
            $src_x = $canvasPosition->x;
            $src_w = $canvasSize->width;
        } else {
            $dst_x = $imagePosition->x;
            $src_x = 0;
            $src_w = $originalWidth;
        }

        if ($height <= $originalHeight) {
            $dst_y = 0;
            $src_y = $canvasPosition->y;
            $src_h = $canvasSize->height;
        } else {
            $dst_y = $imagePosition->y;
            $src_y = 0;
            $src_h = $originalHeight;
        }

        // make image area transparent to keep transparency
        // even if background-color is set
        $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
        imagealphablending($canvas, false); // do not blend / just overwrite
        imagefilledrectangle($canvas, $dst_x, $dst_y, $dst_x + $src_w - 1, $dst_y + $src_h - 1, $transparent);

        // copy image into new canvas
        imagecopy($canvas, $image->getCore(), $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);

        // set new core to canvas
        $this->replaceCore($image, $canvas);

        return null;
    }
}
