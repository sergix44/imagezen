---
sidebar_position: 10
_modified_: false
---
# `heavyBlur()`

```php
->heavyBlur([int $amount = 10]): SergiX44\ImageZen\Image
```
Apply a heavy blur effect to the image.

## Parameters

- `int $amount`: The amount of blur to apply (1-100)


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->heavyBlur([int $amount = 10]);

```
