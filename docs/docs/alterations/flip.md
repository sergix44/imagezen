---
sidebar_position: 24
_modified_: false
---
# `flip()`

```php
->flip([SergiX44\ImageZen\Draws\Flip $flip = SergiX44\ImageZen\Draws\Flip::HORIZONTAL]): SergiX44\ImageZen\Image
```
Flip the image along the horizontal or vertical axis.

## Parameters

- `SergiX44\ImageZen\Draws\Flip $flip`: The direction to flip the image


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->flip([SergiX44\ImageZen\Draws\Flip $flip = SergiX44\ImageZen\Draws\Flip::HORIZONTAL]);

```
