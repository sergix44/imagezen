---
sidebar_position: 13
_modified_: true
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
use SergiX44\ImageZen\Shapes\Circle;
use SergiX44\ImageZen\Draws\Color;

$image = Image::make('path/to/image.jpg', Backend::IMAGICK)
    ->circle(100, 50, 50, function (Circle $draw) {
        $draw->background(Color::red());
        $draw->border(1, Color::black());
    }); // draws a red circle with a black border of 1px with imagick

```
