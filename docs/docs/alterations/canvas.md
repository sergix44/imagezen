---
sidebar_position: 1
_modified_: true
---

# `canvas()`

```php
->canvas(int $width, int $height, [?SergiX44\ImageZen\Draws\Color $color = null], [SergiX44\ImageZen\Backend $backend = SergiX44\ImageZen\Backend::GD]): self
```

Initialize an empty canvas.

## Parameters

- `int $width`: The image width.
- `int $height`: The image height.
- `?SergiX44\ImageZen\Draws\Color $color`: The image background color.
- `SergiX44\ImageZen\Backend $backend`: The backend to use, default is GD.

## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Draws\Color;

$image = Image::make('path/to/image.jpg')
    ->canvas(300, 200); // creates a 300x200 transparent canvas
    
$image = Image::make('path/to/image.jpg')
    ->canvas(300, 200, Color::RED); // creates a 300x200 red canvas
    
$image = Image::make('path/to/image.jpg')
    ->canvas(300, 200, Color::red(), Backend::IMAGICK); // creates a 300x200 red canvas using Imagick
```
