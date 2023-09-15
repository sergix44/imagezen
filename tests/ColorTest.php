<?php

use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Image;

it('can get a color of a pixel', function ($driver, $file) {
    $color = Image::make($file, $driver)->pickColor(2, 2);

    expect($color)->toBeInstanceOf(Color::class)
        ->and($color->red)->toBe(180)
        ->and($color->green)->toBe(224)
        ->and($color->blue)->toBe(0)
        ->and($color->alpha)->toBe(1);
})->with('drivers', 'tile');

it('the transparency is the same for the same pixel', function ($driver, $file) {
    $color = Image::make($file, $driver)->pickColor(9, 1);

    expect($color)->toBeInstanceOf(Color::class)
        ->and($color->red)->toBe(68)
        ->and($color->green)->toBe(81)
        ->and($color->blue)->toBe(96)
        ->and($color->alpha)->toBe(1);
})->with('drivers', 'tile');
