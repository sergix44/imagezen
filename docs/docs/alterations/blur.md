---
sidebar_position: 9
_modified_: false
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
    ->blur([int $amount = 1]);

```
