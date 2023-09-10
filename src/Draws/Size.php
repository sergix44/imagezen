<?php

namespace SergiX44\ImageZen\Draws;

use Closure;
use SergiX44\ImageZen\Shapes\Point;

class Size
{
    public ?int $width;
    public ?int $height;
    public ?Point $pivot;

    /**
     * @param  int|null  $width
     * @param  int|null  $height
     * @param  Point|null  $pivot
     */
    public function __construct(?int $width, ?int $height, ?Point $pivot = null)
    {
        $this->width = $width;
        $this->height = $height;
        $this->pivot = $pivot ?? new Point();
    }

    /**
     * Set the width and height absolutely
     *
     * @param  int  $width
     * @param  int  $height
     */
    public function set(int $width, int $height): void
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Set current pivot point
     *
     * @param  Point  $point
     */
    public function setPivot(Point $point): void
    {
        $this->pivot = $point;
    }

    /**
     * Get the current width
     *
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Get the current height
     *
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Calculate the current aspect ratio
     *
     * @return float
     */
    public function getRatio(): float
    {
        return $this->width / $this->height;
    }

    /**
     * Resize to desired width and/or height
     *
     * @param  int|null  $width
     * @param  int|null  $height
     * @param  Closure|null  $callback
     * @return Size
     */
    public function resize(?int $width, ?int $height, ?Closure $callback = null): self
    {
        // new size with dominant width
        $dominantWidth = clone $this;
        $dominantWidth->resizeHeight($height, $callback);
        $dominantWidth->resizeWidth($width, $callback);

        // new size with dominant height
        $dominantHeight = clone $this;
        $dominantHeight->resizeWidth($width, $callback);
        $dominantHeight->resizeHeight($height, $callback);

        // decide which size to use
        if ($dominantHeight->fitsInto(new self($width, $height))) {
            $this->set($dominantHeight->width, $dominantHeight->height);
        } else {
            $this->set($dominantWidth->width, $dominantWidth->height);
        }

        return $this;
    }

    /**
     * Scale size according to given constraints
     *
     * @param  int|null  $width
     * @param  Closure|null  $callback
     */
    private function resizeWidth(?int $width, Closure $callback = null): void
    {
        if ($width === null) {
            return;
        }

        $constraint = $this->getConstraint($callback);

        $maxWidth = 0;
        $maxHeight = 0;
        if ($constraint->isFixed(Constraint::UPSIZE)) {
            $maxWidth = $constraint->getSize()->getWidth();
            $maxHeight = $constraint->getSize()->getHeight();
        }

        if ($constraint->isFixed(Constraint::UPSIZE)) {
            $this->width = ($width > $maxWidth) ? $maxWidth : $width;
        } else {
            $this->width = $width;
        }

        if ($constraint->isFixed(Constraint::ASPECT_RATIO)) {
            $h = max(1, (int) round($this->width / $constraint->getSize()->getRatio()));

            if ($constraint->isFixed(Constraint::UPSIZE)) {
                $this->height = ($h > $maxHeight) ? $maxHeight : $h;
            } else {
                $this->height = $h;
            }
        }
    }

    /**
     * Scale size according to given constraints
     *
     * @param  int|null  $height
     * @param  Closure|null  $callback
     */
    private function resizeHeight(?int $height, Closure $callback = null): void
    {
        if ($height === null) {
            return;
        }

        $constraint = $this->getConstraint($callback);

        $maxWidth = 0;
        $maxHeight = 0;
        if ($constraint->isFixed(Constraint::UPSIZE)) {
            $maxWidth = $constraint->getSize()->getWidth();
            $maxHeight = $constraint->getSize()->getHeight();
        }

        if ($constraint->isFixed(Constraint::UPSIZE)) {
            $this->height = ($height > $maxHeight) ? $maxHeight : $height;
        } else {
            $this->height = $height;
        }

        if ($constraint->isFixed(Constraint::ASPECT_RATIO)) {
            $w = max(1, (int) round($this->height * $constraint->getSize()->getRatio()));

            if ($constraint->isFixed(Constraint::UPSIZE)) {
                $this->width = ($w > $maxWidth) ? $maxWidth : $w;
            } else {
                $this->width = $w;
            }
        }
    }

    /**
     * Calculate the relative position to another Size
     * based on the pivot point settings of both sizes.
     *
     * @param  Size  $size
     * @return Point
     */
    public function relativePosition(Size $size): Point
    {
        $x = $this->pivot->x - $size->pivot->x;
        $y = $this->pivot->y - $size->pivot->y;

        return new Point($x, $y);
    }

    /**
     * Resize given Size to best fitting size of current size.
     *
     * @param  Size  $size
     * @param  Position  $position
     * @return Size
     */
    public function fit(Size $size, Position $position = Position::CENTER): self
    {
        // create size with auto height
        $autoHeight = clone $size;

        $autoHeight->resize($this->width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // decide which version to use
        if ($autoHeight->fitsInto($this)) {
            $size = $autoHeight;
        } else {
            // create size with auto width
            $autoWidth = clone $size;

            $autoWidth->resize(null, $this->height, function ($constraint) {
                $constraint->aspectRatio();
            });

            $size = $autoWidth;
        }

        $this->align($position);
        $size->align($position);
        $size->setPivot($this->relativePosition($size));

        return $size;
    }

    /**
     * Checks if given size fits into current size
     *
     * @param  Size  $size
     * @return bool
     */
    public function fitsInto(Size $size): bool
    {
        return ($this->width <= $size->width) && ($this->height <= $size->height);
    }

    /**
     * Aligns current size's pivot point to given position
     * and moves point automatically by offset.
     *
     * @param  Position  $position
     * @param  int|null  $offsetX
     * @param  int|null  $offsetY
     * @return Size
     */
    public function align(Position $position, ?int $offsetX = 0, ?int $offsetY = 0): self
    {
        $offsetX ??= 0;
        $offsetY ??= 0;
        switch ($position) {

            case Position::TOP:
            case Position::TOP_MIDDLE:
                $x = (int) ($this->width / 2);
                $y = $offsetY;

                break;

            case Position::TOP_RIGHT:
                $x = $this->width - $offsetX;
                $y = $offsetY;

                break;

            case Position::LEFT:
            case Position::CENTER_LEFT:
                $x = $offsetX;
                $y = (int) ($this->height / 2);

                break;

            case Position::RIGHT:
            case Position::CENTER_RIGHT:
                $x = $this->width - $offsetX;
                $y = (int) ($this->height / 2);

                break;

            case Position::BOTTOM_LEFT:
                $x = $offsetX;
                $y = $this->height - $offsetY;

                break;

            case Position::BOTTOM:
            case Position::BOTTOM_MIDDLE:
                $x = (int) ($this->width / 2);
                $y = $this->height - $offsetY;

                break;

            case Position::BOTTOM_RIGHT:
                $x = $this->width - $offsetX;
                $y = $this->height - $offsetY;

                break;

            case Position::CENTER:
            case Position::CENTER_MIDDLE:
                $x = ((int) $this->width / 2) + $offsetX;
                $y = ((int) $this->height / 2) + $offsetY;

                break;

            default:
                $x = $offsetX;
                $y = $offsetY;

                break;
        }

        $this->pivot->setPosition($x, $y);

        return $this;
    }

    /**
     * Runs constraints on current size
     *
     * @param  Closure|null  $callback
     * @return Constraint
     */
    private function getConstraint(Closure $callback = null): Constraint
    {
        $constraint = new Constraint(clone $this);

        if ($callback !== null) {
            $callback($constraint);
        }

        return $constraint;
    }

    public function equals(Size $size): bool
    {
        return $this->width === $size->width && $this->height === $size->height;
    }

    public function getBox(): Box
    {
        if ($this->pivot === null) {
            throw new \RuntimeException('Pivot is null');
        }

        return new Box(
            lowerLeft: new Point($this->pivot->x, $this->pivot->y + $this->height),
            lowerRight: new Point($this->pivot->x + $this->width, $this->pivot->y + $this->height),
            upperRight: new Point($this->pivot->x + $this->width, $this->pivot->y),
            upperLeft: $this->pivot,
        );
    }
}
