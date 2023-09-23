---
sidebar_position: 45
_modified_: true
---
# `sharpen()`

```php
->sharpen([int $amount = 10]): SergiX44\ImageZen\Image
```
Sharpen the image.

## Parameters

- `int $amount`: The amount of sharpening (1-100)


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->sharpen(20); // sharpen the image by 20%

```
