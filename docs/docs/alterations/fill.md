# `fill()`

```
->fill(SergiX44\ImageZen\Draws\Color|SergiX44\ImageZen\Image $filling, [?int $x = null], [?int $y = null]): self
```
## Parameters

- `SergiX44\ImageZen\Draws\Color|SergiX44\ImageZen\Image $filling`: 
- `?int $x`: 
- `?int $y`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->fill(SergiX44\ImageZen\Draws\Color|SergiX44\ImageZen\Image $filling, [?int $x = null], [?int $y = null]);

```
