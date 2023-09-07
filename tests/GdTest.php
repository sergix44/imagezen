<?php

use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Shapes\Ellipse;

beforeEach()->skip(fn () => !extension_loaded('gd'), 'gd extension not loaded.');

it('can create an empty canvas', function () {
    $filename = 'empty_canvas';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png", 100);

    unlink($out);
});

it('can create an empty canvas with a color', function () {
    $filename = 'colored_canvas';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100, Color::fuchsia())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png", 100);

    unlink($out);
});

it('can blur an image', function ($file) {
    $filename = 'baboon_blur';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->blur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can heavy blur an image', function ($file) {
    $filename = 'baboon_heavy_blur';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->heavyBlur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can blur an image with a custom amount', function ($file) {
    $filename = 'baboon_blur_50';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->blur(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can heavy blur an image with a custom amount', function ($file) {
    $filename = 'baboon_heavy_blur_50';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->heavyBlur(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can change brightness of an image', function ($file) {
    $filename = 'baboon_brightness_50';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->brightness(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can draw an ellipse', function () {
    $filename = 'ellipse_on_canvas';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100)
        ->ellipse(55, 20, 50, 50, function (Ellipse $draw) {
            $draw->background(Color::fuchsia())
                ->border(2, Color::green());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
});

it('can draw a circle', function () {
    $filename = 'circle_on_canvas';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100)
        ->circle(50, 50, 50, function (Ellipse $draw) {
            $draw->background(Color::black())
                ->border(2, Color::gold());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
});
