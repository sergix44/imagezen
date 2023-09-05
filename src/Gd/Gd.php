<?php

namespace SergiX44\ImageZen\Gd;

use SergiX44\ImageZen\Driver;

class Gd implements Driver
{
    public function isAvailable(): bool
    {
        return extension_loaded('gd');
    }

    public function apply(string $effect, ...$args): Driver
    {
        // TODO: Implement apply() method.
    }
}
