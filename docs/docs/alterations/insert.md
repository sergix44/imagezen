# `insert()`

```
->insert(SergiX44\ImageZen\Image $image, [SergiX44\ImageZen\Draws\Position $position = SergiX44\ImageZen\Draws\Position::CENTER], [?int $x = null], [?int $y = null]): self
```
## Parameters

- `SergiX44\ImageZen\Image $image`: 
- `SergiX44\ImageZen\Draws\Position $position`: 
- `?int $x`: 
- `?int $y`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->insert(SergiX44\ImageZen\Image $image, [SergiX44\ImageZen\Draws\Position $position = SergiX44\ImageZen\Draws\Position::CENTER], [?int $x = null], [?int $y = null]);

```
