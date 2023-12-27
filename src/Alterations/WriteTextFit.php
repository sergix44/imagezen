<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use RuntimeException;
use SergiX44\ImageZen\Draws\Size;
use SergiX44\ImageZen\Drivers\Gd\Gd;
use SergiX44\ImageZen\Drivers\Gd\GdText;
use SergiX44\ImageZen\Drivers\Imagick\Imagick;
use SergiX44\ImageZen\Drivers\Imagick\ImagickText;
use SergiX44\ImageZen\Image;

class WriteTextFit extends AbstractText
{
    public static string $id = 'fitText';

    public function __construct(
        protected string $text,
        protected Size $size,
        protected ?Closure $callback = null
    ) {
    }

    public function applyWithGd(Image $image): mixed
    {
        $text = new GdText($this->text);
        if ($this->callback instanceof Closure) {
            call_user_func($this->callback, $text);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Gd)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $boxText = $text->getBox();
        while (!$boxText->getSize()->fitsInto($this->size)) {
            $text->size($text->size - 0.2);
            $boxText = $text->getBox();
        }

        $this->writeWithGd(
            $image,
            $text,
            $driver,
            $this->size->pivot->x + 1,
            $this->size->pivot->y + $text->getPointSize() + 1,
        );

        return null;
    }

    public function applyWithImagick(Image $image): mixed
    {
        $text = new ImagickText($this->text);
        if ($this->callback instanceof Closure) {
            call_user_func($this->callback, $text);
        }

        $driver = $image->getDriver();
        if (!($driver instanceof Imagick)) {
            throw new RuntimeException('Invalid driver for this alteration');
        }

        $boxText = $text->getBox();
        while (!$boxText->getSize()->fitsInto($this->size)) {
            $text->size($text->size - 0.2);
            $boxText = $text->getBox();
        }

        $this->writeWithImagick(
            $image,
            $text,
            $driver,
            $this->size->pivot->x,
            $this->size->pivot->y,
        );

        return null;
    }
}
