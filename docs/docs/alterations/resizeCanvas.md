# `resizeCanvas()`

```
->resizeCanvas(?int $width, ?int $height, [SergiX44\ImageZen\Draws\Position $anchor = SergiX44\ImageZen\Draws\Position::CENTER], [bool $relative = false], [?SergiX44\ImageZen\Draws\Color $background = null]): self
```
## Parameters

- `?int $width`: 
- `?int $height`: 
- `SergiX44\ImageZen\Draws\Position $anchor`: 
- `bool $relative`: 
- `?SergiX44\ImageZen\Draws\Color $background`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->resizeCanvas(?int $width, ?int $height, [SergiX44\ImageZen\Draws\Position $anchor = SergiX44\ImageZen\Draws\Position::CENTER], [bool $relative = false], [?SergiX44\ImageZen\Draws\Color $background = null]);

```
