# `rotate()`

```
->rotate(float $angle, [?SergiX44\ImageZen\Draws\Color $background = null]): self
```
## Parameters

- `float $angle`: 
- `?SergiX44\ImageZen\Draws\Color $background`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->rotate(float $angle, [?SergiX44\ImageZen\Draws\Color $background = null]);

```
