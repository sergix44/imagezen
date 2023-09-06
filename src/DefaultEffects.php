<?php

namespace SergiX44\ImageZen;

trait DefaultEffects
{
    public function blur(int $amount = 1): self
    {
        $this->effect(__FUNCTION__, $amount);

        return $this;
    }

    public function heavyBlur(int $amount = 10): self
    {
        $this->effect(__FUNCTION__, $amount);

        return $this;
    }
}
