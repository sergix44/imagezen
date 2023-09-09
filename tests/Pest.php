<?php

// Custom asserts

use SapientPro\ImageComparator\ImageComparator;

expect()->extend('imageSimilarTo', function ($expected, $threshold = 99) {
    $imageComparator = new ImageComparator();
    $similarity = $imageComparator->compare($expected, $this->value);
    expect($similarity)->toBeGreaterThanOrEqual($threshold, "Images are not similar enough (expected: $threshold, actual: $similarity).");

    return $this;
});

// Datasets
dataset('baboon', [
    [__DIR__.'/Images/baboon.png'],
]);

dataset('tile', [
    [__DIR__.'/Images/tile.png'],
]);
dataset('fruit', [
    [__DIR__.'/Images/fruit_tray.gif'],
]);
dataset('exif', [
    [__DIR__.'/Images/exif.jpg'],
]);
