<?php

use SergiX44\ImageZen\Backend;
use SergiX44\ImageZen\Image;

beforeEach()->skip(fn() => !extension_loaded('imagick'), 'imagick extension not loaded.');

it('can blur an image', function ($file) {
    $filename = 'baboon_blur';
    $out = __DIR__ . "/Tmp/$filename.png";
    Image::make($file, Backend::IMAGICK)
        ->blur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Imagick/$filename.png");

    unlink($out);
})->with('baboon');
