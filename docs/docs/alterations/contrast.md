---
sidebar_position: 15
_modified_: true
---
# `contrast()`

```php
->contrast(int $level): SergiX44\ImageZen\Image
```
Changes the contrast of the image.

## Parameters

- `int $level`: The amount of contrast to apply (-100 to 100)


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->contrast(50); // increase contrast
    
$image = Image::make('path/to/image.jpg')
    ->contrast(-50); // decrease contrast

```
