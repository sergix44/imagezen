<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use RuntimeException;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdText;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickText;
use SergiX44\ImageZen\Image;

class WriteText extends AbstractText
{
    public static string $id = 'text';

    public function __construct(
        protected string $text,
        protected int $x,
        protected int $y,
        protected ?Closure $callback = null
    ) {
    }

    public function applyWithGd(Image $image): null
    {
        $text = new GdText($this->text);
        if ($this->callback instanceof Closure) {
            call_user_func($this->callback, $text);
        }

        $x = $this->x;
        $y = $this->y;

        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $this->writeWithGd($image, $text, $driver, $x, $y);

        return null;
    }

    public function applyWithImagick(Image $image): null
    {
        $text = new ImagickText($this->text);
        if ($this->callback instanceof Closure) {
            call_user_func($this->callback, $text);
        }

        $x = $this->x;
        $y = $this->y;

        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $this->writeWithImagick($image, $text, $driver, $x, $y);

        return null;
    }
}
