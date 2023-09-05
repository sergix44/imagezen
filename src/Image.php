<?php

namespace SergiX44\ImageZen;

use GdImage;
use Imagick;

class Image implements API
{
    protected GdImage|Imagick $image;

    protected Driver $driver;

    public function __construct(mixed $image, Backend $driver = Backend::GD)
    {
        $this->image = $image;
    }

    public function getCore(): GdImage|Imagick
    {
        return $this->image;
    }

    public function blur(int $amount): self
    {
        $this->driver->apply(__FUNCTION__, $this->image, $amount);
        return $this;
    }
}
