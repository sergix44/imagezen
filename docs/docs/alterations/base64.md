---
sidebar_position: 1
_modified_: true
---
# `base64()`

```php
->base64([SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]): string
```
Return the image as base64 encoded string.

## Parameters

- `SergiX44\ImageZen\Format $format`: The image format, default is PNG.
- `int $quality`: The image quality, default is 90, if supported by the format.


## Returns

`string`: The image as base64 string.

## Example

```php
use SergiX44\ImageZen\Image;

$base64 = Image::make('path/to/image.jpg')->base64(\SergiX44\ImageZen\Format::JPG); // data:image/jpg;base64,...

```
