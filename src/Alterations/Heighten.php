<?php

namespace SergiX44\ImageZen\Alterations;

use Closure;
use SergiX44\ImageZen\Draws\Constraint;

class Heighten extends Resize
{
    public static string $id = 'heighten';

    public function __construct(protected ?int $height, protected ?Closure $callback = null)
    {
        parent::__construct(
            null,
            $height,
            static function (Constraint $constraint) use ($callback) {
                $constraint->aspectRatio();
                if (is_callable($callback)) {
                    $callback($constraint);
                }
            }
        );
    }
}
