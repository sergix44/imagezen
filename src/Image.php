<?php

namespace SergiX44\ImageZen;

use GdImage;
use GuzzleHttp\Psr7\Response;
use Imagick;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Size;
use SergiX44\ImageZen\Drivers\Driver;
use SergiX44\ImageZen\Drivers\DriverSwitcher;
use SergiX44\ImageZen\Exceptions\AlterationAlreadyRegistered;
use SergiX44\ImageZen\Exceptions\InvalidAlterationException;

class Image
{
    use DefaultAlterations;
    use DriverSwitcher;

    /** @var array<string,Alteration> */
    protected array $alterations = [];

    protected array $snapshots = [];

    protected GdImage|Imagick $image;

    protected Driver $driver;

    protected Backend $backend;

    protected ?string $basePath = null;

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
            if (file_exists($image)) {
                $this->basePath = $image;
            }

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

    public static function canvas(int $width, int $height, Color $color = null, Backend $backend = Backend::GD): self
    {
        $image = $backend->getDriver()->newImage($width, $height, $color ?? Color::transparent());

        return new self($image, $backend);
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
     * @param  string  $alteration
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

    public function filter(Filter $filter)
    {
        $value = $filter->apply($this);

        return $value ?? $this;
    }

    public function backup(?string $name = null): self
    {
        if ($name === null) {
            $this->snapshots[] = $this->driver->clone($this);
        } else {
            $this->snapshots[$name] = $this->driver->clone($this);
        }

        return $this;
    }

    public function reset(?string $name = null): self
    {
        if ($name !== null) {
            if (!array_key_exists($name, $this->snapshots)) {
                throw new InvalidArgumentException("Snapshot '$name' not found.");
            }
            $this->driver->clear($this);
            $this->image = $this->snapshots[$name];
            unset($this->snapshots[$name]);
        } else {
            if (empty($this->snapshots)) {
                throw new InvalidArgumentException('No snapshots found.');
            }
            $this->driver->clear($this);
            $this->image = array_pop($this->snapshots);
        }

        return $this;
    }

    public function save(string $path, Format $format = Format::PNG, int $quality = 90): bool
    {
        return $this->driver->save($this, $path, $format, $quality);
    }

    public function stream(Format $format = Format::PNG, int $quality = 90): StreamInterface
    {
        return $this->driver->getStream($this, $format, $quality);
    }

    public function basePath(): ?string
    {
        return $this->basePath;
    }

    public function response(Format $format, int $quality = 90): ResponseInterface
    {
        return new Response(
            status: 200,
            headers: [
                'Content-Type' => $this->mime(),
            ],
            body: $this->stream($format, $quality),
        );
    }

    public function __call(string $name, array $arguments)
    {
        return $this->alterate($name, ...$arguments);
    }

    public function destroy(): void
    {
        $this->__destruct();
    }

    public function getSize(): Size
    {
        return new Size($this->width(), $this->height());
    }

    public function __destruct()
    {
        array_map(fn ($snapshot) => $this->driver->clear(raw: $snapshot), $this->snapshots);
        $this->driver->clear($this);
    }
}
