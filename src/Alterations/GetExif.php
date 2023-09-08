<?php

namespace SergiX44\ImageZen\Alterations;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class GetExif extends Alteration implements GdAlteration, ImagickAlteration
{

    public static string $id = 'exif';

    public function __construct(protected ?string $key = null)
    {
    }

    protected function getExif(Image $image): array|false|string
    {
        if (!function_exists('exif_read_data')) {
            throw new RuntimeException("Reading Exif data is not supported by this PHP installation.");
        }

        $stream = $image->stream()->detach();
        $data = @exif_read_data($stream);

        if (is_array($data) && $this->key !== null) {
            return array_key_exists($this->key, $data) ? $data[$this->key] : false;
        }

        return $data;
    }

    public function applyWithGd(Image $image): mixed
    {
        return $this->getExif($image);
    }

    public function applyWithImagick(Image $image): mixed
    {
        $this->getExif($image);
    }
}
