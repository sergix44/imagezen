---
sidebar_position: 28
_modified_: false
---
# `interlace()`

```php
->interlace([bool $interlace = true]): SergiX44\ImageZen\Image
```
Interlace the image.

## Parameters

- `bool $interlace`: Whether to interlace the image or not


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->interlace([bool $interlace = true]);

```
