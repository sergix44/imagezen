<?php

namespace SergiX44\ImageZen\Draws;

enum Position: string
{
    case TOP = 'top';
    case TOP_MIDDLE = 'top-middle';
    case TOP_LEFT = 'top-left';
    case TOP_RIGHT = 'top-right';
    case CENTER = 'center';
    case CENTER_MIDDLE = 'center-middle';
    case CENTER_LEFT = 'center-left';
    case CENTER_RIGHT = 'center-right';
    case BOTTOM = 'bottom';
    case BOTTOM_MIDDLE = 'bottom-middle';
    case BOTTOM_LEFT = 'bottom-left';
    case BOTTOM_RIGHT = 'bottom-right';
    case LEFT = 'left';
    case RIGHT = 'right';



    public function toImagickGravity(): int
    {
        return match ($this) {
            self::TOP => \Imagick::GRAVITY_NORTH,
            self::TOP_MIDDLE => \Imagick::GRAVITY_NORTH,
            self::TOP_LEFT => \Imagick::GRAVITY_NORTHWEST,
            self::TOP_RIGHT => \Imagick::GRAVITY_NORTHEAST,
            self::CENTER => \Imagick::GRAVITY_CENTER,
            self::CENTER_MIDDLE => \Imagick::GRAVITY_CENTER,
            self::CENTER_LEFT => \Imagick::GRAVITY_WEST,
            self::CENTER_RIGHT => \Imagick::GRAVITY_EAST,
            self::BOTTOM => \Imagick::GRAVITY_SOUTH,
            self::BOTTOM_MIDDLE => \Imagick::GRAVITY_SOUTH,
            self::BOTTOM_LEFT => \Imagick::GRAVITY_SOUTHWEST,
            self::BOTTOM_RIGHT => \Imagick::GRAVITY_SOUTHEAST,
            self::LEFT => \Imagick::GRAVITY_WEST,
            self::RIGHT => \Imagick::GRAVITY_EAST,
        };
    }
}
