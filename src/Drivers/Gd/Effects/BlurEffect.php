<?php

namespace SergiX44\ImageZen\Drivers\Gd\Effects;

use InvalidArgumentException;
use SergiX44\ImageZen\Base\Effect;
use SergiX44\ImageZen\Image;

class BlurEffect extends Effect
{
    public static string $id = 'blur';

    protected int $amount = 1;

    public function __construct(array $arguments)
    {
        parent::__construct($arguments);
        if (isset($arguments[0]) && is_int($arguments[0])) {
            $amount = $arguments[0];
            if ($amount < 1 || $amount > 100) {
                throw new InvalidArgumentException('Blur amount must be between 1 and 100');
            }
            $this->amount = $arguments[0];
        }
    }

    public function apply(Image $image): null
    {
        for ($i = 0; $i < $this->amount; $i++) {
            imagefilter($image->getCore(), IMG_FILTER_GAUSSIAN_BLUR);
        }

        return null;
    }
}
