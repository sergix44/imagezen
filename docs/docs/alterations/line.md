---
sidebar_position: 33
_modified_: true
---

# `line()`

```php
->line(int $x1, int $y1, int $x2, int $y2, [?Closure $callback = null]): SergiX44\ImageZen\Image
```

Draw a line shape on the image.

## Parameters

- `int $x1`: The x-coordinate of the first point
- `int $y1`: The y-coordinate of the first point
- `int $x2`: The x-coordinate of the second point
- `int $y2`: The y-coordinate of the second point
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Shapes\Line

## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->line(0, 0, 100, 100, function (\SergiX44\ImageZen\Shapes\Line $line)  {
        $line->color(\SergiX44\ImageZen\Draws\Color::red())
            ->width(5);
    };
); // draw a red line from (0, 0) to (100, 100)

```
