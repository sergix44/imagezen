<?php

namespace SergiX44\ImageZen\Drivers;

trait DecodeDataUriImage
{

    public function isDataUriImage(string $string): bool
    {
        return str_starts_with($string, 'data:image/');
    }

    public function decodeDataUriImage(string $string): string
    {
        if (!$this->isDataUriImage($string)) {
            return $string;
        }

        if (str_contains($string, ';base64,')) {
            return base64_decode(explode(';base64,', $string)[1]);
        }

        return urldecode(explode(',', $string)[1]);
    }
}
