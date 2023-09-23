---
sidebar_position: 29
_modified_: true
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
    ->interlace(true); // interlace the image
    
$image = Image::make('path/to/image.jpg')
    ->interlace(false); // don't interlace the image

```
