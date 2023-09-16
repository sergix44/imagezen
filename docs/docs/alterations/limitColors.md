# `limitColors()`

```
->limitColors(int $count, [?SergiX44\ImageZen\Draws\Color $matte = null]): self
```
## Parameters

- `int $count`: 
- `?SergiX44\ImageZen\Draws\Color $matte`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->limitColors(int $count, [?SergiX44\ImageZen\Draws\Color $matte = null]);

```
