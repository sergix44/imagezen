<?php

use SergiX44\ImageZen\Image;

it('can blur an image', function ($file) {
    $filename = 'baboon_blur';
    $out = __DIR__ . "/Tmp/$filename.png";
    Image::make($file)
        ->blur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can heavy blur an image', function ($file) {
    $filename = 'baboon_heavy_blur';
    $out = __DIR__ . "/Tmp/$filename.png";
    Image::make($file)
        ->heavyBlur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can blur an image with a custom amount', function ($file) {
    $filename = 'baboon_blur_50';
    $out = __DIR__ . "/Tmp/$filename.png";
    Image::make($file)
        ->blur(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can heavy blur an image with a custom amount', function ($file) {
    $filename = 'baboon_heavy_blur_50';
    $out = __DIR__ . "/Tmp/$filename.png";
    Image::make($file)
        ->heavyBlur(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can change brightness of an image', function ($file) {
    $filename = 'baboon_brightness_50';
    $out = __DIR__ . "/Tmp/$filename.png";
    Image::make($file)
        ->brightness(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');
