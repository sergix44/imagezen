<?php

namespace SergiX44\ImageZen;

enum Format: int
{
    case PNG = 0;
    case JPG = 1;
    case WEBP = 2;
    case GIF = 3;
    case BMP = 4;
    case TIFF = 5;
    case HEIC = 6;
    case AVIF = 7;

    public function name(): string
    {
        return match ($this) {
            self::PNG => 'png',
            self::JPG => 'jpg',
            self::WEBP => 'webp',
            self::GIF => 'gif',
            self::BMP => 'bmp',
            self::TIFF => 'tiff',
            self::HEIC => 'heic',
            self::AVIF => 'avif',
        };
    }

    public function mime()
    {
        return match ($this) {
            self::PNG => 'image/png',
            self::JPG => 'image/jpeg',
            self::WEBP => 'image/webp',
            self::GIF => 'image/gif',
            self::BMP => 'image/bmp',
            self::TIFF => 'image/tiff',
            self::HEIC => 'image/heic',
            self::AVIF => 'image/avif',
        };
    }
}
