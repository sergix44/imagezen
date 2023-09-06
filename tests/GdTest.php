<?php

use SergiX44\ImageZen\Image;

describe('gd driver', function () {

    it('can blur an image', function ($file) {
        $out = __DIR__.'/Tmp/baboon_blur.png';
        Image::make($file)
            ->blur()
            ->save($out, quality: 100);

        expect($out)
            ->toBeFile()
            ->imageSimilarTo(__DIR__.'/Images/Gd/baboon_blur.png');

        unlink($out);
    })->with('baboon');

    it('can heavy blur an image', function ($file) {
        $out = __DIR__.'/Tmp/baboon_heavy_blur.png';
        Image::make($file)
            ->heavyBlur()
            ->save($out, quality: 100);

        expect($out)
            ->toBeFile()
            ->imageSimilarTo(__DIR__.'/Images/Gd/baboon_heavy_blur.png');

        unlink($out);
    })->with('baboon');

});
