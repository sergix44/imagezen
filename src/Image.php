<?php

namespace SergiX44\ImageZen;

use GdImage;
use Imagick;
use SergiX44\ImageZen\Base\Driver;

class Image
{
    use DefaultEffects;

    protected GdImage|Imagick $image;

    protected Driver $driver;

    public function __construct(GdImage|Imagick|string $image, Backend $driver = Backend::GD)
    {
        if (is_string($image) && file_exists($image)) {
            $this->driver = $driver->getDriver();
            $this->image = $this->driver->loadImageFrom($image);
        } else {
            $this->driver = Backend::matchFromImage($image)->getDriver();
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
        $value = $this->driver->apply($effect, $this, $args);

        return $value ?? $this;
    }

    public function save(string $path, Format $format = Format::PNG, int $quality = 90): bool
    {
        return $this->driver->save($this, $path, $format, $quality);
    }

    public function __call(string $name, array $arguments)
    {
        $value = $this->driver->apply($name, $this, $arguments);
        return $value ?? $this;
    }

    public function __destruct()
    {
        $this->driver->clear($this);
    }
}
