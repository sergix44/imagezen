<?php

namespace SergiX44\ImageZen\Draws;

trait DefaultColors
{
    public static function white(): self
    {
        return new self('#ffffff');
    }

    public static function black(): self
    {
        return new self('#000000');
    }

    public static function transparent(): self
    {
        return new self(red: 255, green: 255, blue: 255, alpha: 0);
    }

    public static function red(): self
    {
        return new self('#ff0000');
    }

    public static function green(): self
    {
        return new self('#00ff00');
    }

    public static function blue(): self
    {
        return new self('#0000ff');
    }

    public static function yellow(): self
    {
        return new self('#ffff00');
    }

    public static function cyan(): self
    {
        return new self('#00ffff');
    }

    public static function magenta(): self
    {
        return new self('#ff00ff');
    }

    public static function gray(): self
    {
        return new self('#808080');
    }

    public static function grey(): self
    {
        return new self('#808080');
    }

    public static function maroon(): self
    {
        return new self('#800000');
    }

    public static function olive(): self
    {
        return new self('#808000');
    }

    public static function greenDark(): self
    {
        return new self('#008000');
    }

    public static function purple(): self
    {
        return new self('#800080');
    }

    public static function teal(): self
    {
        return new self('#008080');
    }

    public static function navy(): self
    {
        return new self('#000080');
    }

    public static function silver(): self
    {
        return new self('#c0c0c0');
    }

    public static function lime(): self
    {
        return new self('#00ff00');
    }

    public static function aqua(): self
    {
        return new self('#00ffff');
    }

    public static function fuchsia(): self
    {
        return new self('#ff00ff');
    }

    public static function orange(): self
    {
        return new self('#ffa500');
    }

    public static function pink(): self
    {
        return new self('#ffc0cb');
    }

    public static function brown(): self
    {
        return new self('#a52a2a');
    }

    public static function gold(): self
    {
        return new self('#ffd700');
    }

    public static function beige(): self
    {
        return new self('#f5f5dc');
    }

    public static function wheat(): self
    {
        return new self('#f5deb3');
    }
}
