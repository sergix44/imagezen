<?php

namespace SergiX44\ImageZen;

use GdImage;
use Imagick;
use SergiX44\ImageZen\Api\API;
use SergiX44\ImageZen\Base\Driver;

class Image
{
    use API;

    protected GdImage|Imagick $image;

    protected Driver $driver;

    public function __construct(GdImage|Imagick|string $image, Backend $driver = Backend::GD)
    {
        if (is_string($image) && file_exists($image)) {
            $this->driver = $driver->getDriver();
            $this->image = $this->driver->loadImageFromDisk($image);
        } else {
            $this->driver = match (true) {
                $image instanceof GdImage => Backend::GD->getDriver(),
                $image instanceof Imagick => Backend::IMAGICK->getDriver()
            };
            $this->image = $image;
        }
    }

    public static function make(GdImage|Imagick|string $image, Backend $driver = Backend::GD): self
    {
        return new self($image, $driver);
    }

    public function getCore(): GdImage|Imagick
    {
        return $this->image;
    }

    public function getDriver(): Driver
    {
        return $this->driver;
    }

    public function effect(string $effect, ...$args): mixed
    {
        $return = $this->driver->apply($effect, $this, ...$args);
        return $return ?? $this;
    }

    public function save(string $path, Format $format = Format::PNG, int $quality = 90): bool
    {
        return $this->driver->save($this, $path, $format, $quality);
    }
}
