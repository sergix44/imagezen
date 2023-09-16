# `stream()`

```
->stream([SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]): Psr\Http\Message\StreamInterface
```
## Parameters

- `SergiX44\ImageZen\Format $format`: 
- `int $quality`: 


## Returns

`Psr\Http\Message\StreamInterface`: 

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->stream([SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]);

```
