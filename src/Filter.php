<?php

namespace SergiX44\ImageZen;

interface Filter
{
    public function apply(Image $image): mixed;
}
