---
sidebar_position: 11
_modified_: true
---
# `brightness()`

```php
->brightness([int $level = 0]): SergiX44\ImageZen\Image
```
Changes the brightness of the image.

## Parameters

- `int $level`: The amount of brightness to apply (-100 to 100)


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->brightness(20); // increases the brightness by 20
    
$image = Image::make('path/to/image.jpg')
    ->brightness(-30); // decreases the brightness by 30

```
