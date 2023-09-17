---
sidebar_position: 26
_modified_: false
---
# `heighten()`

```php
->heighten(int $height, [?Closure $callback = null]): SergiX44\ImageZen\Image
```
Heighten the image to the given height.

## Parameters

- `int $height`: The height to heighten the image to
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Constraints


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->heighten(int $height, [?Closure $callback = null]);

```
