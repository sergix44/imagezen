# `response()`

```
->response(SergiX44\ImageZen\Format $format, [int $quality = 90]): Psr\Http\Message\ResponseInterface
```
## Parameters

- `SergiX44\ImageZen\Format $format`: 
- `int $quality`: 


## Returns

`Psr\Http\Message\ResponseInterface`: 

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->response(SergiX44\ImageZen\Format $format, [int $quality = 90]);

```
