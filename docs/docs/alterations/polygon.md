---
sidebar_position: 40
_modified_: true
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
    ->polygon([
        [0, 0],
        [100, 100],
        [100, 0],
    ], function (\SergiX44\ImageZen\Shapes\Polygon $polygon)  {
        $polygon->border(5, \SergiX44\ImageZen\Draws\Color::red());
    }; // draw a red polygon with 3 points

```
