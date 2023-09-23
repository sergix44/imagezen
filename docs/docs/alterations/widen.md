---
sidebar_position: 48
_modified_: true
---
# `widen()`

```php
->widen(int $width, [?Closure $callback = null]): SergiX44\ImageZen\Image
```
Widen the image to the given width.

## Parameters

- `int $width`: The width to widen the image to
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Draws\Constraint


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->widen(100); // widen the image to 100 pixels
    
$image = Image::make('path/to/image.jpg')
    ->widen(100, function (\SergiX44\ImageZen\Draws\Constraint $constraints) {
        $constraints->aspectRatio(); // constrain aspect ratio (auto width and height)
    }); // widen the image to 100 pixels and constrain aspect ratio (auto width and height)

```
