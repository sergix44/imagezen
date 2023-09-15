<?php

namespace SergiX44\ImageZen\Support;

class Common
{
    public static function mapRange(int $value, int $fromMin, int $fromMax, int $toMin, int $toMax): int
    {
        $value = min(max($value, $fromMin), $fromMax);
        $fromRange = $fromMax - $fromMin;
        $toRange = $toMax - $toMin;
        $scaledValue = ($value - $fromMin) / $fromRange;

        return $toMin + ($scaledValue * $toRange);
    }
}
