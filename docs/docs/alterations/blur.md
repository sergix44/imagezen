---
sidebar_position: 9
_modified_: true
---
# `blur()`

```php
->blur([int $amount = 1]): SergiX44\ImageZen\Image
```
Apply a blur effect to the image.

## Parameters

- `int $amount`: The amount of blur to apply (1-100)


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->blur(20); // applies a blur effect with an amount of 20

```
