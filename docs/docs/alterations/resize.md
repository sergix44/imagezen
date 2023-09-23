---
sidebar_position: 42
_modified_: true
---
# `resize()`

```php
->resize([?int $width = null], [?int $height = null], [?Closure $constraints = null]): SergiX44\ImageZen\Image
```
Resizes current image based on given width and/or height. To constraint the resize command, pass an optional Closure callback as third parameter.

## Parameters

- `?int $width`: The width to resize the image to
- `?int $height`: The height to resize the image to
- `?Closure $constraints`: A callback that is passed an instance of SergiX44\ImageZen\Constraints


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->resize(100, 100); // resize the image to 100x100 pixels
    
$image = Image::make('path/to/image.jpg')
    ->resize(null, 100); // resize the image to a width of 100 pixels and constrain aspect ratio (auto height)
    
$image = Image::make('path/to/image.jpg')
    ->resize(100, null); // resize the image to a height of 100 pixels and constrain aspect ratio (auto width)
    
$image = Image::make('path/to/image.jpg')
    ->resize(100, 100, function (\SergiX44\ImageZen\Constraints $constraints) {
        $constraints->aspectRatio(); // constrain aspect ratio (auto width and height)
    }); // resize the image to 100x100 pixels and constrain aspect ratio (auto width and height)

```
