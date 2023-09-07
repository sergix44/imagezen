<?php

namespace SergiX44\ImageZen;

use Closure;

trait DefaultAlterations
{
    protected function registerDefaultAlterations(): void
    {
        $this->register(Alterations\Blur::class);
        $this->register(Alterations\HeavyBlur::class);
        $this->register(Alterations\Brightness::class);
        $this->register(Alterations\EllipseShape::class);
        $this->register(Alterations\CircleShape::class);
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
}
