<?php

namespace SergiX44\ImageZen\Api;

trait API
{
    public function blur(int $amount = 1): self
    {
        $this->effect(__FUNCTION__, $amount);

        return $this;
    }
}
