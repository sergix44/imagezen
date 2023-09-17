---
sidebar_position: 38
_modified_: false
---
# `pixelate()`

```php
->pixelate(int $size): SergiX44\ImageZen\Image
```
Pixelate a given part of the image.

## Parameters

- `int $size`: The amount of pixelation


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->pixelate(int $size);

```
