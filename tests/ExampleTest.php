<?php

it('can test', function () {
    $i = imagecreate(1, 1);
    $image = new \SergiX44\ImageZen\Image($i);
    expect($image->getCore())->toBe($i);
});
