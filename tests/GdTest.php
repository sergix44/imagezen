<?php

use SergiX44\ImageZen\Image;

describe('gd driver', function () {

    it('can blur an image', function ($file) {
        $out = __DIR__.'/Tmp/baboon_blur.png';
        Image::make($file)
            ->blur(1)
            ->save($out, quality: 100);

        expect($out)
            ->toBeFile()
            ->imageSimilarTo(__DIR__.'/Images/Gd/baboon_blur.png');

        unlink($out);
    })->with('baboon');

});
