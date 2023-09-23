---
sidebar_position: 11
_modified_: true
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
    ->heavyBlur(10); // apply a heavy blur effect

```
