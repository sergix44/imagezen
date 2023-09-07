<?php

use SergiX44\ImageZen\Backend;
use SergiX44\ImageZen\Image;

it('can create a snapshot with gd', function ($file) {
    $filename = 'baboon_blur';
    $out = __DIR__ . "/Tmp/$filename.png";

    $img = Image::make($file)->backup();
    $img->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($file);

    $img->blur();
    $img->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Gd/$filename.png");

    $img->reset();
    $img->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($file);

    unlink($out);
})->with('baboon')->skip(fn () => !extension_loaded('gd'), 'gd extension not loaded.');
;

it('can create a snapshot with imagick', function ($file) {
    $filename = 'baboon_blur';
    $out = __DIR__ . "/Tmp/$filename.png";

    $img = Image::make($file, Backend::IMAGICK)->backup();
    $img->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($file);

    $img->blur();
    $img->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Imagick/$filename.png");

    $img->reset();
    $img->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($file);

    unlink($out);
})->with('baboon')->skip(fn () => !extension_loaded('imagick'), 'imagick extension not loaded.');
