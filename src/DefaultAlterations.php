<?php

namespace SergiX44\ImageZen;

trait DefaultAlterations
{
    protected function registerDefaultAlterations(): void
    {
        $this->register(Alterations\Blur::class);
        $this->register(Alterations\HeavyBlur::class);
        $this->register(Alterations\Brightness::class);
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
}
