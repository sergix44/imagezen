<?php

namespace SergiX44\ImageZen;

use SergiX44\ImageZen\Gd\Gd;
use SergiX44\ImageZen\Imagick\Imagick;

enum Backend: string
{
    case GD = Gd::class;
    case IMAGICK = Imagick::class;

    public function getDriver(): Driver
    {
        return new ($this->value);
    }
}
