---
sidebar_position: 44
_modified_: true
---
# `rotate()`

```php
->rotate(float $angle, [?SergiX44\ImageZen\Draws\Color $background = null]): SergiX44\ImageZen\Image
```
Rotate the image by a given number of degrees.

## Parameters

- `float $angle`: The number of degrees to rotate the image by
- `?SergiX44\ImageZen\Draws\Color $background`: The background color to use for the uncovered area, default is transparent


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->rotate(45); // rotate the image by 45 degrees
    
$image = Image::make('path/to/image.jpg')
    ->rotate(45, \SergiX44\ImageZen\Draws\Color::red()); // rotate the image by 45 degrees and set the background color to red

```
