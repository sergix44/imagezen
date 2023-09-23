---
sidebar_position: 9
_modified_: true
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

class MyController
{
    public function myImage(): Psr\Http\Message\ResponseInterface
    {
        return Image::make('path/to/image.jpg')->response();
    }
}

```
