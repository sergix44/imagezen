---
sidebar_position: 43
_modified_: false
---
# `resizeCanvas()`

```php
->resizeCanvas(?int $width, ?int $height, [SergiX44\ImageZen\Draws\Position $anchor = SergiX44\ImageZen\Draws\Position::CENTER], [bool $relative = false], [?SergiX44\ImageZen\Draws\Color $background = null]): SergiX44\ImageZen\Image
```
Resize the boundaries of the current image to given width and height. An anchor can be defined to determine from what point of the image the resizing is going to happen. Set the mode to relative to add or subtract the given width or height to the actual image dimensions. You can also pass a background color for the emerging area of the image.

## Parameters

- `?int $width`: The width to resize the image to
- `?int $height`: The height to resize the image to
- `SergiX44\ImageZen\Draws\Position $anchor`: The anchor point of the resize operation
- `bool $relative`: Whether to use relative dimensions or not
- `?SergiX44\ImageZen\Draws\Color $background`: The background color to use for the uncovered area


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->resizeCanvas(?int $width, ?int $height, [SergiX44\ImageZen\Draws\Position $anchor = SergiX44\ImageZen\Draws\Position::CENTER], [bool $relative = false], [?SergiX44\ImageZen\Draws\Color $background = null]);

```
