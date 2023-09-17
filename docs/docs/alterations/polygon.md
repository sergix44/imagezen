---
sidebar_position: 39
_modified_: false
---
# `polygon()`

```php
->polygon(array $points, [?Closure $callback = null]): SergiX44\ImageZen\Image
```
Draw a polygon shape on the image.

## Parameters

- `array $points`: The points of the polygon
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Shapes\Polygon


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->polygon(array $points, [?Closure $callback = null]);

```
