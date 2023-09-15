<?php

use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Image;

it('can get a color of a pixel', function ($driver, $file) {
    $color = Image::make($file, $driver)->pickColor(2, 2);

    expect($color)->toBeInstanceOf(Color::class)
        ->and($color->red)->toBe(180)
        ->and($color->green)->toBe(224)
        ->and($color->blue)->toBe(0)
        ->and($color->alpha)->toBe(1.0);
})->with('drivers', 'tile');

it('the transparency is the same for the fully transparent same pixel', function ($driver, $file) {
    $color = Image::make($file, $driver)->pickColor(9, 1);

    expect($color)->toBeInstanceOf(Color::class)
        ->and($color->alpha)->toBe(0.0);
})->with('drivers', 'tile');

it('the colors and transparency are the same for the same pixel', function ($driver, $file) {
    $color = Image::make($file, $driver)->pickColor(2, 2);

    expect($color)->toBeInstanceOf(Color::class)
        ->and($color->red)->toBe(208)
        ->and($color->green)->toBe(56)
        ->and($color->blue)->toBe(56)
        ->and($color->alpha)->toBe(0.94);
})->with('drivers', 'semi');
