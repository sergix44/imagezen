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

    /**
     * Initialize a new Image instance from a file path or a resource.
     *
     * @param GdImage|Imagick|string $image The image path or resource.
     * @param Backend $driver The backend to use, default is GD.
     * @return Image
     */
    public static function make(GdImage|Imagick|string $image, Backend $driver = Backend::GD): self
    {
        return new self($image, $driver);
    }

    /**
     * Initialize an empty canvas.
     *
     * @param int $width The image width.
     * @param int $height The image height.
     * @param Color|null $color The image background color.
     * @param Backend $backend The backend to use, default is GD.
     * @return Image
     */
    public static function canvas(int $width, int $height, Color $color = null, Backend $backend = Backend::GD): self
    {
        $image = $backend->getDriver()->newImage($width, $height, $color ?? Color::transparent());

        return new self($image, $backend);
    }

    /**
     * Register a new alteration.
     *
     * @param class-string ...$classes A class or a list of classes extending the Alteration base class.
     * @return Image
     * @throws AlterationAlreadyRegistered
     * @throws InvalidAlterationException
     */
    public function register(string ...$classes): self
    {
        foreach ($classes as $class) {
            if (!is_subclass_of($class, Alteration::class)) {
                throw new InvalidAlterationException();
            }
            $id = $class::$id;

            if (array_key_exists($id, $this->alterations)) {
                throw new AlterationAlreadyRegistered();
            }

            $this->alterations[$class::$id] = $class;
        }

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

    /**
     * Apply a filter to the image.
     *
     * @param Filter $filter
     * @return mixed
     */
    public function filter(Filter $filter)
    {
        $value = $filter->apply($this);

        return $value ?? $this;
    }

    /**
     * Store a snapshot of the image for future restoration.
     *
     * @param string|null $name The snapshot name.
     * @return Image
     */
    public function backup(?string $name = null): self
    {
        if ($name === null) {
            $this->snapshots[] = $this->driver->clone($this);
        } else {
            $this->snapshots[$name] = $this->driver->clone($this);
        }

        return $this;
    }

    /**
     * Restore a snapshot of the image.
     *
     * @param string|null $name The snapshot name, if null the last snapshot will be restored.
     * @return Image
     */
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

    /**
     * Save the image to a file.
     *
     * @param string $path The file path.
     * @param Format $format The image format, default is PNG.
     * @param int $quality The image quality, default is 90, if supported by the format.
     * @return bool True if the image was saved successfully, false otherwise.
     */
    public function save(string $path, Format $format = Format::PNG, int $quality = 90): bool
    {
        return $this->driver->save($this, $path, $format, $quality);
    }

    /**
     * Get the image as stream.
     *
     * @param Format $format The image format, default is PNG.
     * @param int $quality The image quality, default is 90, if supported by the format.
     * @return StreamInterface The image stream.
     */
    public function stream(Format $format = Format::PNG, int $quality = 90): StreamInterface
    {
        return $this->driver->getStream($this, $format, $quality);
    }

    /**
     * Get the image path if it was loaded from a file.
     *
     * @return string|null The image path.
     */
    public function basePath(): ?string
    {
        return $this->basePath;
    }

    /**
     * Return a PSR-7 response with the image as body.
     *
     * @param Format $format The image format, default is PNG.
     * @param int $quality The image quality, default is 90, if supported by the format.
     * @return ResponseInterface The PSR-7 response.
     */
    public function response(Format $format = Format::PNG, int $quality = 90): ResponseInterface
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

    /**
     * Clear the image from memory, after this the image is no longer usable.
     *
     * @return void
     */
    public function destroy(): void
    {
        $this->__destruct();
    }

    public function getSize(): Size
    {
        return new Size($this->width(), $this->height());
    }

    public function __clone(): void
    {
        $this->image = $this->driver->clone($this);
    }

    public function __destruct()
    {
        array_map(fn ($snapshot) => $this->driver->clear(raw: $snapshot), $this->snapshots);
        $this->driver->clear($this);
    }
}
