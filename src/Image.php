<?php

namespace SergiX44\ImageZen;

use GdImage;
use Imagick;
use InvalidArgumentException;
use RuntimeException;
use SergiX44\ImageZen\Drivers\Driver;
use SergiX44\ImageZen\Drivers\DriverSwitcher;
use SergiX44\ImageZen\Exceptions\AlterationAlreadyRegistered;
use SergiX44\ImageZen\Exceptions\InvalidAlterationException;

class Image
{
    use DefaultAlterations, DriverSwitcher;

    /** @var array<string,Alteration> */
    protected array $alterations = [];

    protected GdImage|Imagick $image;

    protected Driver $driver;

    protected Backend $backend;

    public function __construct(GdImage|Imagick|string $image, Backend $backend = Backend::GD)
    {
        if (is_object($image)) {
            $backend = Backend::fromObject($image);
        }
        $this->driver = $backend->getDriver();

        if (!$this->driver->isAvailable()) {
            throw new RuntimeException('The selected backend not available.');
        }

        if (is_string($image)) {
            $this->image = $this->driver->loadImageFrom($image);
        } else {
            $this->image = $image;
        }
        $this->backend = $backend;
        $this->registerDefaultAlterations();
    }

    public static function make(GdImage|Imagick|string $image, Backend $driver = Backend::GD): self
    {
        return new self($image, $driver);
    }

    public function register(string $class): self
    {
        if (!is_subclass_of($class, Alteration::class)) {
            throw new InvalidAlterationException();
        }
        $id = $class::$id;

        if (array_key_exists($id, $this->alterations)) {
            throw new AlterationAlreadyRegistered();
        }

        $this->alterations[$class::$id] = $class;

        return $this;
    }

    public function getCore(): GdImage|Imagick
    {
        return $this->image;
    }

    public function getDriver(): Driver
    {
        return $this->driver;
    }

    /**
     * @param string $alteration
     * @param ...$args
     * @return mixed
     */
    public function alterate(string $alteration, ...$args): mixed
    {
        if (!array_key_exists($alteration, $this->alterations)) {
            throw new InvalidArgumentException('Alteration not found');
        }

        $instance = $this->alterations[$alteration]::make(...$args);
        $value = $this->driver->apply($instance, $this);

        return $value ?? $this;
    }

    public function save(string $path, Format $format = Format::PNG, int $quality = 90): bool
    {
        return $this->driver->save($this, $path, $format, $quality);
    }

    public function __call(string $name, array $arguments)
    {
        $value = $this->driver->alterate($name, ...$arguments);

        return $value ?? $this;
    }

    public function __destruct()
    {
        $this->driver->clear($this);
    }
}
