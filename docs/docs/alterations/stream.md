---
sidebar_position: 7
_modified_: false
---
# `stream()`

```php
->stream([SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]): Psr\Http\Message\StreamInterface
```
Get the image as stream.

## Parameters

- `SergiX44\ImageZen\Format $format`: The image format, default is PNG.
- `int $quality`: The image quality, default is 90, if supported by the format.


## Returns

`Psr\Http\Message\StreamInterface`: The image stream.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->stream([SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]);

```
