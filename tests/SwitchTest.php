<?php

use SergiX44\ImageZen\Backend;
use SergiX44\ImageZen\Image;

it('can switch from gd to imagick', function ($file) {
    $filename = 'baboon_blur';

    $out = __DIR__ . "/Tmp/$filename.png";
    Image::make($file)
        ->blur()
        ->switchTo(Backend::IMAGICK)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can switch from imagick to gd', function ($file) {
    $filename = 'baboon_blur';

    $out = __DIR__ . "/Tmp/$filename.png";
    Image::make($file, Backend::IMAGICK)
        ->blur()
        ->switchTo(Backend::GD)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__ . "/Images/Imagick/$filename.png");

    unlink($out);
})->with('baboon');
