---
sidebar_position: 8
_modified_: true
---
# `stream()`

```php
->stream([SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]): Psr\Http\Message\StreamInterface
```
Get the image as stream.

See [Supported Formats](/docs/supported-formats#supported-formats-1) for a list of supported formats.

## Parameters

- `SergiX44\ImageZen\Format $format`: The image format, default is PNG.
- `int $quality`: The image quality, default is 90, if supported by the format.


## Returns

`Psr\Http\Message\StreamInterface`: The image stream.

## Example

```php
use SergiX44\ImageZen\Image;

$stream = Image::make('path/to/image.jpg')->stream();

$stream = Image::make('path/to/image.jpg')
    ->stream(\SergiX44\ImageZen\Format::PNG); // save the image as PNG
    
$stream = Image::make('path/to/image.jpg')
    ->stream(\SergiX44\ImageZen\Format::\SergiX44\ImageZen\JPG, 50); // save the image as JPG with a quality of 50


```
