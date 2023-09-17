---
sidebar_position: 41
_modified_: false
---
# `resize()`

```php
->resize([?int $width = null], [?int $height = null], [?Closure $constraints = null]): SergiX44\ImageZen\Image
```
Resizes current image based on given width and/or height. To constraint the resize command, pass an optional Closure callback as third parameter.

## Parameters

- `?int $width`: The width to resize the image to
- `?int $height`: The height to resize the image to
- `?Closure $constraints`: A callback that is passed an instance of SergiX44\ImageZen\Constraints


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->resize([?int $width = null], [?int $height = null], [?Closure $constraints = null]);

```
