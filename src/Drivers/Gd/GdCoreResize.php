<?php

namespace SergiX44\ImageZen\Drivers\Gd;

use GdImage;

trait GdCoreResize
{

    protected function coreResize(
        GdImage $gd,
        int $newX,
        int $newY,
        int $currentX,
        int $currentY,
        int $newWidth,
        int $newHeight,
        int $currentWidth,
        int $currentHeight
    ): GdImage {
        // create new image
        $modified = imagecreatetruecolor($newWidth, $newHeight);

        // preserve transparency
        $transIndex = imagecolortransparent($gd);

        if ($transIndex !== -1) {
            $rgba = imagecolorsforindex($modified, $transIndex);
            $transColor = imagecolorallocatealpha($modified, $rgba['red'], $rgba['green'], $rgba['blue'], 127);
            imagefill($modified, 0, 0, $transColor);
            imagecolortransparent($modified, $transColor);
        } else {
            imagealphablending($modified, false);
            imagesavealpha($modified, true);
        }

        // copy content from resource
        imagecopyresampled(
            $modified,
            $gd,
            $newX,
            $newY,
            $currentX,
            $currentY,
            $newWidth,
            $newHeight,
            $currentWidth,
            $currentHeight
        );

        return $modified;
    }

}
