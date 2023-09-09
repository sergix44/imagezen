<?php

namespace SergiX44\ImageZen\Draws;

use InvalidArgumentException;

class Color
{
    use DefaultColors;

    public int $red;
    public int $green;
    public int $blue;
    public int $alpha;

    private function __construct(
        ?string $string = null,
        int $red = 0,
        int $green = 0,
        int $blue = 0,
        int $alpha = 1
    ) {
        if ($string !== null) {
            [$red, $green, $blue, $alpha] = $this->rgbaFromString($string);
        }

        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        $this->alpha = $alpha;
    }

    public static function from(string $hex): self
    {
        return new self(string: $hex);
    }

    public static function fromInt(int $value): self
    {
        $alpha = ($value >> 24) & 0xFF;
        return new self(
            red: ($value >> 16) & 0xFF,
            green: ($value >> 8) & 0xFF,
            blue: $value & 0xFF,
            alpha: round(1 - $alpha / 127, 2)
        );
    }

    public static function rgb(int $red, int $green, int $blue): self
    {
        return new self(red: $red, green: $green, blue: $blue);
    }

    public static function rgba(int $red, int $green, int $blue, int $alpha): self
    {
        return new self(red: $red, green: $green, blue: $blue, alpha: $alpha);
    }

    public function differs(Color $color, int $tolerance = 0): bool
    {
        $colorDeltaMax = round($tolerance * 2.55);
        $alphaDeltaMax = round($tolerance * 1.27);

        return (
            abs($color->red - $this->red) > $colorDeltaMax ||
            abs($color->green - $this->green) > $colorDeltaMax ||
            abs($color->blue - $this->blue) > $colorDeltaMax ||
            abs($color->alpha - $this->alpha) > $alphaDeltaMax
        );
    }

    public function toHex(): string
    {
        return sprintf('#%02x%02x%02x', $this->red, $this->green, $this->blue);
    }

    /**
     * Reads RGBA values from string into array
     *
     * @param  string  $value
     * @return array
     */
    protected function rgbaFromString($value)
    {
        // parse color string in hexidecimal format like #cccccc or cccccc or ccc
        $hexPattern = '/^#?([a-f0-9]{1,2})([a-f0-9]{1,2})([a-f0-9]{1,2})$/i';

        // parse color string in format rgb(140, 140, 140)
        $rgbPattern = '/^rgb ?\(([0-9]{1,3}), ?([0-9]{1,3}), ?([0-9]{1,3})\)$/i';

        // parse color string in format rgba(255, 0, 0, 0.5)
        $rgbaPattern = '/^rgba ?\(([0-9]{1,3}), ?([0-9]{1,3}), ?([0-9]{1,3}), ?([0-9.]{1,4})\)$/i';

        $result = [];
        if (preg_match($hexPattern, $value, $matches)) {
            $result[0] = strlen($matches[1]) === 1 ? hexdec($matches[1].$matches[1]) : hexdec($matches[1]);
            $result[1] = strlen($matches[2]) === 1 ? hexdec($matches[2].$matches[2]) : hexdec($matches[2]);
            $result[2] = strlen($matches[3]) === 1 ? hexdec($matches[3].$matches[3]) : hexdec($matches[3]);
            $result[3] = 1;
        } elseif (preg_match($rgbPattern, $value, $matches)) {
            $result[0] = ($matches[1] >= 0 && $matches[1] <= 255) ? (int) $matches[1] : 0;
            $result[1] = ($matches[2] >= 0 && $matches[2] <= 255) ? (int) $matches[2] : 0;
            $result[2] = ($matches[3] >= 0 && $matches[3] <= 255) ? (int) $matches[3] : 0;
            $result[3] = 1;
        } elseif (preg_match($rgbaPattern, $value, $matches)) {
            $result[0] = ($matches[1] >= 0 && $matches[1] <= 255) ? (int) $matches[1] : 0;
            $result[1] = ($matches[2] >= 0 && $matches[2] <= 255) ? (int) $matches[2] : 0;
            $result[2] = ($matches[3] >= 0 && $matches[3] <= 255) ? (int) $matches[3] : 0;
            $result[3] = ($matches[4] >= 0 && $matches[4] <= 1) ? $matches[4] : 0;
        } else {
            throw new InvalidArgumentException("Unable to read color ({$value}).");
        }

        return $result;
    }
}
