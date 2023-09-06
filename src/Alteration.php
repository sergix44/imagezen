<?php

namespace SergiX44\ImageZen;

abstract class Alteration
{
    public static string $id;

    public static function make(...$args): self
    {
        return new static(...$args);
    }
}
