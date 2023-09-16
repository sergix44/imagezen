# `canvas()`

```
->canvas(int $width, int $height, [?SergiX44\ImageZen\Draws\Color $color = null], [SergiX44\ImageZen\Backend $backend = SergiX44\ImageZen\Backend::GD]): self
```
## Parameters

- `int $width`: 
- `int $height`: 
- `?SergiX44\ImageZen\Draws\Color $color`: 
- `SergiX44\ImageZen\Backend $backend`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->canvas(int $width, int $height, [?SergiX44\ImageZen\Draws\Color $color = null], [SergiX44\ImageZen\Backend $backend = SergiX44\ImageZen\Backend::GD]);

```
