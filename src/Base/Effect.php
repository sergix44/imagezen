<?php

namespace SergiX44\ImageZen\Base;

use SergiX44\ImageZen\Image;

abstract class Effect
{
    public static string $id;

    abstract public function apply(Image $image): mixed;
}
