<?php

it('gets the same text sizes across drivers', closure: function () {
    $gd = new \SergiX44\ImageZen\Drivers\Gd\GdText('Hello World');
    $im = new \SergiX44\ImageZen\Drivers\Imagick\ImagickText('Hello World');

    $gdbox = $gd->getBox();
    $imbox = $im->getBox();

    // sadly the box computation is not exactly the same across drivers and OSes
    // so we have to allow a small margin of error
    $marginError = 6;
    expect($gdbox->lowerLeft->x)->toBeBetween($imbox->lowerLeft->x - $marginError, $imbox->lowerLeft->x + $marginError)
        ->and($gdbox->lowerLeft->y)->toBeBetween($imbox->lowerLeft->y - $marginError, $imbox->lowerLeft->y + $marginError)
        ->and($gdbox->lowerRight->x)->toBeBetween($imbox->lowerRight->x - $marginError, $imbox->lowerRight->x + $marginError)
        ->and($gdbox->lowerRight->y)->toBeBetween($imbox->lowerRight->y - $marginError, $imbox->lowerRight->y + $marginError)
        ->and($gdbox->upperLeft->x)->toBeBetween($imbox->upperLeft->x - $marginError, $imbox->upperLeft->x + $marginError)
        ->and($gdbox->upperLeft->y)->toBeBetween($imbox->upperLeft->y - $marginError, $imbox->upperLeft->y + $marginError)
        ->and($gdbox->upperRight->x)->toBeBetween($imbox->upperRight->x - $marginError, $imbox->upperRight->x + $marginError)
        ->and($gdbox->upperRight->y)->toBeBetween($imbox->upperRight->y - $marginError, $imbox->upperRight->y + $marginError);
});
