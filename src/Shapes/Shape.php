<?php

namespace SergiX44\ImageZen\Shapes;

use SergiX44\ImageZen\Draws\Color;

abstract class Shape
{
    protected Color $background;

    protected Color $borderColor;

    protected int $borderWidth = 0;

    public function hasBorder(): bool
    {
        return $this->borderWidth > 0;
    }

    public function border(int $width, Color $color = null): self
    {
        $this->borderWidth = $width;
        $this->borderColor = $color ?? Color::transparent();

        return $this;
    }

    public function background(Color $color): self
    {
        $this->background = $color;

        return $this;
    }

    public function getBackground(): Color
    {
        return $this->background;
    }

    public function getBorderColor(): Color
    {
        return $this->borderColor;
    }

    public function getBorderWidth(): int
    {
        return $this->borderWidth;
    }


}
