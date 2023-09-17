---
sidebar_position: 44
_modified_: false
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
    ->sharpen([int $amount = 10]);

```
