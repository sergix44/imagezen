<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use SergiX44\ImageZen\Draws\Constraint;

class Widen extends Resize
{
    public static string $id = 'widen';

    public function __construct(?int $width, ?Closure $callback = null)
    {
        parent::__construct(
            $width,
            null,
            static function (Constraint $constraint) use ($callback) {
                $constraint->aspectRatio();
                if (is_callable($callback)) {
                    $callback($constraint);
                }
            }
        );
    }
}
