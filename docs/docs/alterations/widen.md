---
sidebar_position: 48
_modified_: false
---
# `widen()`

```php
->widen(int $width, [?Closure $callback = null]): SergiX44\ImageZen\Image
```
Widen the image to the given width.

## Parameters

- `int $width`: The width to widen the image to
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Constraints


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->widen(int $width, [?Closure $callback = null]);

```
