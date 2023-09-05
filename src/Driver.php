<?php

namespace SergiX44\ImageZen;

use GdImage;
use Imagick;

interface Driver
{
    public function isAvailable(): bool;

    public function apply(string $effect, GdImage|Imagick $image, ...$args): self;
}
