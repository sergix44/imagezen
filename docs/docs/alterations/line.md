---
sidebar_position: 32
_modified_: false
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
    ->line(int $x1, int $y1, int $x2, int $y2, [?Closure $callback = null]);

```
