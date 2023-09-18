---
sidebar_position: 12
_modified_: true
---
# `ellipse()`

```php
->ellipse(int $width, int $height, int $x, int $y, [?Closure $callback = null]): SergiX44\ImageZen\Image
```
Draw an ellipse shape on the image.

## Parameters

- `int $width`: The width of the ellipse
- `int $height`: The height of the ellipse
- `int $x`: The x-coordinate of the center of the ellipse
- `int $y`: The y-coordinate of the center of the ellipse
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Shapes\Ellipse


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Shapes\Ellipse;

$image = Image::make('path/to/image.jpg')
    ->ellipse(100, 50, 50, 50, function (Ellipse $draw) {
        $draw->background(Color::red());
        $draw->border(1, Color::black());
    }); // draws a red ellipse with a black border of 1px

```
