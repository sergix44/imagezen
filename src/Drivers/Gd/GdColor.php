<?php

namespace SergiX44\ImageZen\Drivers\Gd;

use SergiX44\ImageZen\Drivers\ColorDialect;

class GdColor extends ColorDialect
{
    public function getInt()
    {
        $alpha = ceil((($this->color->alpha - 0) * (0 - 127)) + 127);

        return ($alpha << 24) + ($this->color->red << 16) + ($this->color->green << 8) + $this->color->blue;
    }

    public function setAlpha(int|float $alpha)
    {
        if (is_float($alpha)) {
            $alpha = ceil((($alpha) * (0 - 127)) + 127);
        }

        $this->color->alpha = $alpha;
    }
}
