<?php

namespace SergiX44\ImageZen\Getters;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class GetMime extends Alteration implements GdAlteration
{
    public static string $id = 'mime';

    protected function getMimeType(Image $image): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_buffer($finfo, $image->stream()->getContents());
        finfo_close($finfo);

        if ($mime === false) {
            throw new RuntimeException('Unable to get mime type');
        }

        return $mime;
    }

    public function applyWithGd(Image $image): string
    {
        return $this->getMimeType($image);
    }
}
