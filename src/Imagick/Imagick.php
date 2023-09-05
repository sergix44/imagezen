<?php

namespace SergiX44\ImageZen\Imagick;

use SergiX44\ImageZen\Driver;

class Imagick implements Driver
{
    public function isAvailable(): bool
    {
        return class_exists(class: \Imagick::class) && extension_loaded('imagick');
    }

    public function apply(string $effect, ...$args): Driver
    {
        // TODO: Implement apply() method.
    }
}
