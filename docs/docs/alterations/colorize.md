---
sidebar_position: 14
_modified_: true
---
# `colorize()`

```php
->colorize(int $red, int $green, int $blue): SergiX44\ImageZen\Image
```
Alters the colors of the image using a colorize effect.

## Parameters

- `int $red`: The amount of red (0 to 255)
- `int $green`: The amount of green (0 to 255)
- `int $blue`: The amount of blue (0 to 255)


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->colorize(80, 0, 0); // add red color

```
