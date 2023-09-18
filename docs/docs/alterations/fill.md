---
sidebar_position: 22
_modified_: false
---
# `fill()`

```php
->fill(SergiX44\ImageZen\Draws\Color|SergiX44\ImageZen\Image $filling, [?int $x = null], [?int $y = null]): SergiX44\ImageZen\Image
```
Fill the image with a given color or image.

## Parameters

- `SergiX44\ImageZen\Draws\Color|SergiX44\ImageZen\Image $filling`: The color or image to use for filling
- `?int $x`: The x-coordinate of the top-left point
- `?int $y`: The y-coordinate of the top-left point


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->fill(SergiX44\ImageZen\Draws\Color|SergiX44\ImageZen\Image $filling, [?int $x = null], [?int $y = null]);

```
