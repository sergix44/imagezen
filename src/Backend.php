<?php

namespace SergiX44\ImageZen;

use InvalidArgumentException;
use SergiX44\ImageZen\Base\Driver;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;

enum Backend: string
{
    case GD = Gd::class;
    case IMAGICK = Imagick::class;

    public function getDriver(): Driver
    {
        return new ($this->value);
    }

    public static function matchFromImage(mixed $image): self
    {
        return match (true) {
            $image instanceof \GdImage => self::GD,
            $image instanceof \Imagick => self::IMAGICK,
            default => throw new InvalidArgumentException('Unable to match backend from image.')
        };
    }
}
