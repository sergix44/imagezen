---
sidebar_position: 38
_modified_: true
---
# `pixel()`

```php
->pixel(SergiX44\ImageZen\Draws\Color $color, int $x, int $y): SergiX44\ImageZen\Image
```
Change color of a single pixel.

## Parameters

- `SergiX44\ImageZen\Draws\Color $color`: The color to use
- `int $x`: The x-coordinate of the pixel
- `int $y`: The y-coordinate of the pixel


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->pixel(\SergiX44\ImageZen\Draws\Color::red(), 10, 10); // set the color of the pixel at (10, 10) to red

```
