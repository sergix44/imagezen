---
sidebar_position: 16
_modified_: true
---

# `crop()`

```php
->crop(int $width, int $height, [?int $x = null], [?int $y = null]): SergiX44\ImageZen\Image
```

Crop the image to the given dimensions. If no x and y coordinates are given, the center of the image will be used.

## Parameters

- `int $width`: The width of the crop
- `int $height`: The height of the crop
- `?int $x`: The x-coordinate of the crop's center
- `?int $y`: The y-coordinate of the crop's center

## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->crop(200, 200); // crop the image to 200x200 pixels, from the center
    
$image = Image::make('path/to/image.jpg')
    ->crop(200, 200, 0, 0); // crop the image to 200x200 pixels, from the top left corner

```
