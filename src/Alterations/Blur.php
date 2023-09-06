<?php

namespace SergiX44\ImageZen\Alterations;

use InvalidArgumentException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Image;

class Blur extends Alteration implements GdAlteration
{
    public static string $id = 'blur';

    protected int $amount = 1;

    public function __construct(?int $amount = null)
    {
        if ($amount !== null) {
            if ($amount < 1 || $amount > 100) {
                throw new InvalidArgumentException('Blur $amount must be between 1 and 100');
            }
            $this->amount = $amount;
        }
    }

    public function applyWithGd(Image $image): null
    {
        for ($i = 0; $i < $this->amount; $i++) {
            imagefilter($image->getCore(), IMG_FILTER_GAUSSIAN_BLUR);
        }

        return null;
    }
}
