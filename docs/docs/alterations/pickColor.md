---
sidebar_position: 37
_modified_: true
---
# `pickColor()`

```php
->pickColor(int $x, int $y): SergiX44\ImageZen\Draws\Color
```
Get text color at a given position.

## Parameters

- `int $x`: The x-coordinate of the position
- `int $y`: The y-coordinate of the position


## Returns

`SergiX44\ImageZen\Draws\Color`: The color at the given position

## Example

```php
use SergiX44\ImageZen\Image;

$color = Image::make('path/to/image.jpg')->pickColor(10, 10);

```
