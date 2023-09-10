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
        $this->register(Getters\GetWidth::class);
        $this->register(Getters\GetHeight::class);
        $this->register(Alterations\Crop::class);
        $this->register(Getters\GetExif::class);
        $this->register(Getters\GetFilesize::class);
        $this->register(Alterations\Fill::class);
        $this->register(Alterations\Fit::class);
        $this->register(Alterations\Flip::class);
        $this->register(Alterations\Gamma::class);
        $this->register(Alterations\GreyScale::class);
        $this->register(Alterations\Heighten::class);
        $this->register(Alterations\Insert::class);
        $this->register(Alterations\Interlace::class);
        $this->register(Alterations\Invert::class);
        $this->register(Getters\GetIptc::class);
        $this->register(Alterations\LimitColors::class);
        $this->register(Alterations\LineShape::class);
        $this->register(Alterations\Mask::class);
        $this->register(Getters\GetMime::class);
        $this->register(Alterations\Opacity::class);
        $this->register(Alterations\Orientate::class);
        $this->register(Getters\GetColor::class);
        $this->register(Alterations\Pixel::class);
        $this->register(Alterations\Pixelate::class);
        $this->register(Alterations\PolygonShape::class);
        $this->register(Alterations\RectangleShape::class);
        $this->register(Alterations\Resize::class);
        $this->register(Alterations\ResizeCanvas::class);
        $this->register(Alterations\Rotate::class);
        $this->register(Alterations\Sharpen::class);
        // $this->register(Alterations\DrawText::class);
        //        $this->register(Alterations\Trim::class);
        $this->register(Alterations\Widen::class);
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

    public function insert(Image $image, Position $position = Position::CENTER, ?int $x = null, ?int $y = null): self
    {
        $this->alterate(__FUNCTION__, $image, $position, $x, $y);

        return $this;
    }

    public function interlace(bool $interlace = true): self
    {
        $this->alterate(__FUNCTION__, $interlace);

        return $this;
    }

    public function invert(): self
    {
        $this->alterate(__FUNCTION__);

        return $this;
    }

    public function iptc(?string $key = null): array|string|null
    {
        return $this->alterate(__FUNCTION__, $key);
    }

    public function limitColors(int $count, ?Color $matte = null): self
    {
        $this->alterate(__FUNCTION__, $count, $matte);

        return $this;
    }

    public function line(int $x1, int $y1, int $x2, int $y2, Closure $callback): self
    {
        $this->alterate(__FUNCTION__, $x1, $y1, $x2, $y2, $callback);

        return $this;
    }

    public function mask(Image $mask, bool $withAlpha): self
    {
        $this->alterate(__FUNCTION__, $mask, $withAlpha);

        return $this;
    }

    public function mime(): string
    {
        return $this->alterate(__FUNCTION__);
    }

    public function opacity(int $transparency): self
    {
        $this->alterate(__FUNCTION__, $transparency);

        return $this;
    }

    public function pickColor(int $x, int $y): Color
    {
        return $this->alterate(__FUNCTION__, $x, $y);
    }

    public function pixel(Color $color, int $x, int $y): self
    {
        $this->alterate(__FUNCTION__, $color, $x, $y);

        return $this;
    }

    public function pixelate(int $size): self
    {
        $this->alterate(__FUNCTION__, $size);

        return $this;
    }

    public function polygon(array $points, Closure $callback): self
    {
        $this->alterate(__FUNCTION__, $points, $callback);

        return $this;
    }

    public function rectangle(int $x1, int $y1, int $x2, int $y2, Closure $callback): self
    {
        $this->alterate(__FUNCTION__, $x1, $y1, $x2, $y2, $callback);

        return $this;
    }

    public function resize(int $width, int $height, Closure $constraints = null): self
    {
        $this->alterate(__FUNCTION__, $width, $height, $constraints);

        return $this;
    }

    public function resizeCanvas(?int $width, ?int $height, Position $anchor = Position::CENTER, bool $relative = false, Color $background = null): self
    {
        $this->alterate(__FUNCTION__, $width, $height, $anchor, $relative, $background ?? Color::transparent());

        return $this;
    }

    public function rotate(float $angle, ?Color $background = null): self
    {
        $this->alterate(__FUNCTION__, $angle, $background ?? Color::transparent());

        return $this;
    }

    public function sharpen(int $amount = 10): self
    {
        $this->alterate(__FUNCTION__, $amount);

        return $this;
    }

    public function widen(int $width, Closure $callback = null): self
    {
        $this->alterate(__FUNCTION__, $width, $callback);

        return $this;
    }
}
