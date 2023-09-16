# `save()`

```
->save(string $path, [SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]): bool
```
## Parameters

- `string $path`: 
- `SergiX44\ImageZen\Format $format`: 
- `int $quality`: 


## Returns

`bool`: 

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->save(string $path, [SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]);

```
