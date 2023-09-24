<?php

it('gets the same text sizes across drivers', closure: function () {
    $gd = new \SergiX44\ImageZen\Drivers\Gd\GdText('Hello World');
    $im = new \SergiX44\ImageZen\Drivers\Imagick\ImagickText('Hello World');

    $gdbox = $gd->getBox();
    $imbox = $im->getBox();

    expect($gdbox->lowerLeft->x)->toBe($imbox->lowerLeft->x)
        ->and($gdbox->lowerLeft->y)->toBe($imbox->lowerLeft->y)
        ->and($gdbox->lowerRight->x)->toBe($imbox->lowerRight->x - 2)
        ->and($gdbox->lowerRight->y)->toBe($imbox->lowerRight->y)
        ->and($gdbox->upperLeft->x)->toBe($imbox->upperLeft->x)
        ->and($gdbox->upperLeft->y)->toBe($imbox->upperLeft->y + 6)
        ->and($gdbox->upperRight->x)->toBe($imbox->upperRight->x - 2)
        ->and($gdbox->upperRight->y)->toBe($imbox->upperRight->y + 6);
});
