<?php

namespace SergiX44\ImageZen\Draws;

abstract class Text
{
    public string $text;
    public ?string $fontPath;
    public int $size;
    public Color $color;
    public Position $align;
    public int $angle;
    public ?float $stroke = null;
    public Color $strokeColor;
    public ?Color $background = null;
    public int $shadowX = 0;
    public int $shadowY = 0;
    public ?Color $shadowColor = null;
    public ?float $interline = null;

    /**
     * @param string $text
     * @param int $size
     * @param Color|null $color
     * @param string|null $fontPath
     * @param Position $align
     * @param int $angle
     */
    public function __construct(
        string $text,
        int $size = 12,
        ?Color $color = null,
        ?string $fontPath = null,
        Position $align = Position::TOP_LEFT,
        int $angle = 0,
    ) {
        $this->text = $text;
        $this->fontPath = $fontPath ?? __DIR__ . '/../../assets/LiberationSans-Regular.ttf';
        $this->size = $size;
        $this->color = $color ?? Color::black();
        $this->strokeColor = $color ?? Color::white();
        $this->align = $align;
        $this->angle = $angle;
    }

    abstract public function getBox(): Box;

    public function font(?string $font): self
    {
        $this->fontPath = $font;

        return $this;
    }

    public function size(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function color(Color $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function align(Position $align): self
    {
        $this->align = $align;

        return $this;
    }

    public function angle(int $angle): self
    {
        $this->angle = $angle;

        return $this;
    }

    public function stroke(float $stroke, ?Color $color = null): self
    {
        $this->stroke = $stroke;
        $this->strokeColor = $color ?? Color::white();

        return $this;
    }

    public function background(?Color $color = null): self
    {
        $this->background = $color ?? Color::white();

        return $this;
    }

    public function shadow(int $x, int $y, ?Color $color = null): self
    {
        $this->shadowX = $x;
        $this->shadowY = $y;
        $this->shadowColor = $color ?? Color::black();

        return $this;
    }

    public function hasShadow(): bool
    {
        return $this->shadowX !== 0 || $this->shadowY !== 0;
    }

    public function hasFont(): bool
    {
        return $this->fontPath !== null && file_exists($this->fontPath);
    }
}
