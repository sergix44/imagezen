<?php

namespace SergiX44\ImageZen\Draws;

class Constraint
{
    /**
     * Bit value of aspect ratio constraint
     */
    public const ASPECT_RATIO = 1;

    /**
     * Bit value of upsize constraint
     */
    public const UPSIZE = 2;

    /**
     * Constraint size
     */
    private Size $size;

    /**
     * Integer value of fixed parameters
     *
     * @var int
     */
    private int $fixed = 0;

    /**
     * Create a new constraint based on size
     *
     * @param  Size  $size
     */
    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    /**
     * Returns current size of constraint
     *
     * @return Size
     */
    public function getSize(): Size
    {
        return $this->size;
    }

    /**
     * Fix the given argument in current constraint
     *
     * @param  int  $type
     * @return void
     */
    public function fix(int $type): void
    {
        $this->fixed = ($this->fixed & ~(1 << $type)) | (1 << $type);
    }

    /**
     * Checks if given argument is fixed in current constraint
     *
     * @param  int  $type
     * @return bool
     */
    public function isFixed(int $type): bool
    {
        return (bool) ($this->fixed & (1 << $type));
    }

    /**
     * Fixes aspect ratio in current constraint
     *
     * @return void
     */
    public function aspectRatio(): void
    {
        $this->fix(self::ASPECT_RATIO);
    }

    /**
     * Fixes possibility to size up in current constraint
     *
     * @return void
     */
    public function upsize(): void
    {
        $this->fix(self::UPSIZE);
    }
}
