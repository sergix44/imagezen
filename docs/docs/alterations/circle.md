---
sidebar_position: 13
_modified_: false
---
# `circle()`

```php
->circle(int $radius, int $x, int $y, [?Closure $callback = null]): SergiX44\ImageZen\Image
```
Draw a circle shape on the image.

## Parameters

- `int $radius`: The radius of the circle
- `int $x`: The x-coordinate of the center of the circle
- `int $y`: The y-coordinate of the center of the circle
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Shapes\Circle


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->circle(int $radius, int $x, int $y, [?Closure $callback = null]);

```
