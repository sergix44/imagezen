<?php

namespace SergiX44\ImageZen\Base;

use GdImage;
use Imagick;
use SergiX44\ImageZen\Exceptions\EffectAlreadyRegistered;
use SergiX44\ImageZen\Exceptions\EffectNotImplementedException;
use SergiX44\ImageZen\Exceptions\InvalidEffectException;
use SergiX44\ImageZen\Format;
use SergiX44\ImageZen\Image;

abstract class Driver
{
    /**
     * @var Effect[]
     */
    protected array $effects = [];

    abstract public function isAvailable(): bool;

    abstract public function loadImageFrom(string $path): GdImage|Imagick;

    abstract public function save(Image $image, string $path, Format $format, int $quality): bool;

    abstract public function getStream(Image $image, int $quality): mixed;

    abstract public function clear(Image $image): void;

    /**
     * @throws EffectAlreadyRegistered
     * @throws InvalidEffectException
     */
    public function registerEffect(string $class): static
    {
        if (! is_subclass_of($class, Effect::class)) {
            throw new InvalidEffectException();
        }
        $id = $class::$id;

        if (array_key_exists($id, $this->effects)) {
            throw new EffectAlreadyRegistered();
        }

        $this->effects[$id] = $class;

        return $this;
    }

    /**
     * @param  string  $id
     * @param  Image  $image
     * @param  array  $args
     * @return mixed
     * @throws EffectNotImplementedException
     */
    public function apply(string $id, Image $image, array $args = []): mixed
    {
        if (!array_key_exists($id, $this->effects)) {
            throw new EffectNotImplementedException($id);
        }

        /** @var Effect $effect */
        $effect = new ($this->effects[$id])(...$args);

        return $effect->apply($image);
    }

    protected function mapRange(int $value, int $fromMin, int $fromMax, int $toMin, int $toMax): int
    {
        $value = min(max($value, $fromMin), $fromMax);
        $fromRange = $fromMax - $fromMin;
        $toRange = $toMax - $toMin;
        $scaledValue = ($value - $fromMin) / $fromRange;

        return $toMin + ($scaledValue * $toRange);
    }
}
