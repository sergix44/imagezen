# `crop()`

```
->crop(int $width, int $height, [?int $x = null], [?int $y = null]): self
```
## Parameters

- `int $width`: 
- `int $height`: 
- `?int $x`: 
- `?int $y`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->crop(int $width, int $height, [?int $x = null], [?int $y = null]);

```
