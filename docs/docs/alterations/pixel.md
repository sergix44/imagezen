# `pixel()`

```
->pixel(SergiX44\ImageZen\Draws\Color $color, int $x, int $y): self
```
## Parameters

- `SergiX44\ImageZen\Draws\Color $color`: 
- `int $x`: 
- `int $y`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->pixel(SergiX44\ImageZen\Draws\Color $color, int $x, int $y);

```
