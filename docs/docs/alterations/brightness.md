---
sidebar_position: 11
_modified_: false
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
    ->brightness([int $level = 0]);

```
