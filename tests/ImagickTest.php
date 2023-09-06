<?php

use SergiX44\ImageZen\Backend;
use SergiX44\ImageZen\Image;

describe('imagick driver', function () {
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
});
