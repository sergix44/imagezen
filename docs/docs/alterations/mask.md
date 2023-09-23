---
sidebar_position: 34
_modified_: true
---
# `mask()`

```php
->mask(SergiX44\ImageZen\Image $mask, bool $withAlpha): SergiX44\ImageZen\Image
```
Apply a mask to the image.

## Parameters

- `SergiX44\ImageZen\Image $mask`: The image to use as a mask
- `bool $withAlpha`: Whether to apply the alpha channel or not


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$mask = Image::make('path/to/mask.jpg');

$image = Image::make('path/to/image.jpg')
    ->mask($mask, false); // apply the mask without the alpha channel

```
