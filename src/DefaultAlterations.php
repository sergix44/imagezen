<?php

namespace SergiX44\ImageZen;

use Closure;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Flip;
use SergiX44\ImageZen\Draws\Position;

trait DefaultAlterations
{
    protected function registerDefaultAlterations(): void
    {
        $this->register(Alterations\Blur::class);
        $this->register(Alterations\HeavyBlur::class);
        $this->register(Alterations\Brightness::class);
        $this->register(Alterations\EllipseShape::class);
        $this->register(Alterations\CircleShape::class);
        $this->register(Alterations\Colorize::class);
        $this->register(Alterations\Contrast::class);
        $this->register(Alterations\GetWidth::class);
        $this->register(Alterations\GetHeight::class);
        $this->register(Alterations\Crop::class);
        $this->register(Alterations\GetExif::class);
        $this->register(Alterations\GetFilesize::class);
        $this->register(Alterations\Fill::class);
        $this->register(Alterations\Fit::class);
        $this->register(Alterations\Flip::class);
        $this->register(Alterations\Gamma::class);
        $this->register(Alterations\GreyScale::class);
        $this->register(Alterations\Heighten::class);
        $this->register(Alterations\Insert::class);
        $this->register(Alterations\Resize::class);
    }

    public function blur(int $amount = 1): self
    {
        $this->alterate(__FUNCTION__, $amount);

        return $this;
    }

    public function heavyBlur(int $amount = 10): self
    {
        $this->alterate(__FUNCTION__, $amount);

        return $this;
    }

    public function brightness(int $level = 0): self
    {
        $this->alterate(__FUNCTION__, $level);

        return $this;
    }

    public function ellipse(int $width, int $height, int $x, int $y, Closure $callback): self
    {
        $this->alterate(__FUNCTION__, $width, $height, $x, $y, $callback);

        return $this;
    }

    public function circle(int $radius, int $x, int $y, Closure $callback): self
    {
        $this->alterate(__FUNCTION__, $radius, $x, $y, $callback);

        return $this;
    }

    public function colorize(int $red, int $green, int $blue): self
    {
        $this->alterate(__FUNCTION__, $red, $green, $blue);

        return $this;
    }

    public function contrast(int $level): self
    {
        $this->alterate(__FUNCTION__, $level);

        return $this;
    }

    public function crop(int $width, int $height, ?int $x = null, ?int $y = null): self
    {
        $this->alterate(__FUNCTION__, $width, $height, $x, $y);

        return $this;
    }

    public function width(): int
    {
        return $this->alterate(__FUNCTION__);
    }

    public function height(): int
    {
        return $this->alterate(__FUNCTION__);
    }

    public function exif(?string $key = null): array|string|null
    {
        return $this->alterate(__FUNCTION__, $key);
    }

    public function filesize(): int
    {
        return $this->alterate(__FUNCTION__);
    }

    public function fill(Color|Image $filling, ?int $x = null, ?int $y = null): self
    {
        $this->alterate(__FUNCTION__, $filling, $x, $y);

        return $this;
    }

    public function fit(int $width, int $height = null, ?Closure $constraints = null, Position $position = Position::CENTER): self
    {
        $this->alterate(__FUNCTION__, $width, $height, $constraints, $position);

        return $this;
    }

    public function flip(Flip $flip = Flip::HORIZONTAL): self
    {
        $this->alterate(__FUNCTION__, $flip);

        return $this;
    }

    public function gamma(float $correction): self
    {
        $this->alterate(__FUNCTION__, $correction);

        return $this;
    }

    public function greyscale(): self
    {
        $this->alterate(__FUNCTION__);

        return $this;
    }

    public function heighten(int $height, Closure $callback = null): self
    {
        $this->alterate(__FUNCTION__, $height, $callback);

        return $this;
    }

    public function resize(int $width, int $height, Closure $constraints = null): self
    {
        $this->alterate(__FUNCTION__, $width, $height, $constraints);

        return $this;
    }

    public function insert(Image $image, Position $position = Position::CENTER, ?int $x = null, ?int $y = null): self
    {
        $this->alterate(__FUNCTION__, $image, $position, $x, $y);

        return $this;
    }
}
