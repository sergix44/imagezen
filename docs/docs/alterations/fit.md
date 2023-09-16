# `fit()`

```
->fit(int $width, [?int $height = null], [?Closure $constraints = null], [SergiX44\ImageZen\Draws\Position $position = SergiX44\ImageZen\Draws\Position::CENTER]): self
```
## Parameters

- `int $width`: 
- `?int $height`: 
- `?Closure $constraints`: 
- `SergiX44\ImageZen\Draws\Position $position`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->fit(int $width, [?int $height = null], [?Closure $constraints = null], [SergiX44\ImageZen\Draws\Position $position = SergiX44\ImageZen\Draws\Position::CENTER]);

```
