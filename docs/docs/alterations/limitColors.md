---
sidebar_position: 32
_modified_: false
---
# `limitColors()`

```php
->limitColors(int $count, [?SergiX44\ImageZen\Draws\Color $matte = null]): SergiX44\ImageZen\Image
```
Limit the number of colors of the image.

## Parameters

- `int $count`: The number of colors to limit the image to
- `?SergiX44\ImageZen\Draws\Color $matte`: The color to use for non-opaque pixels


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->limitColors(int $count, [?SergiX44\ImageZen\Draws\Color $matte = null]);

```
