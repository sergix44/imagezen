---
sidebar_position: 41
_modified_: true
---
# `rectangle()`

```php
->rectangle(int $x1, int $y1, int $x2, int $y2, [?Closure $callback = null]): SergiX44\ImageZen\Image
```
Draw a rectangle shape on the image.

## Parameters

- `int $x1`: The x-coordinate of the top-left point
- `int $y1`: The y-coordinate of the top-left point
- `int $x2`: The x-coordinate of the bottom-right point
- `int $y2`: The y-coordinate of the bottom-right point
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Shapes\Rectangle


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->rectangle(0, 0, 100, 100, function (\SergiX44\ImageZen\Shapes\Rectangle $rectangle)  {
        $rectangle->border(5, \SergiX44\ImageZen\Draws\Color::red());
    }; // draw a red rectangle from (0, 0) to (100, 100)

```
