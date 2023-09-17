---
sidebar_position: 8
_modified_: false
---
# `response()`

```php
->response([SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]): Psr\Http\Message\ResponseInterface
```
Return a PSR-7 response with the image as body.

## Parameters

- `SergiX44\ImageZen\Format $format`: The image format, default is PNG.
- `int $quality`: The image quality, default is 90, if supported by the format.


## Returns

`Psr\Http\Message\ResponseInterface`: The PSR-7 response.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->response([SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]);

```
