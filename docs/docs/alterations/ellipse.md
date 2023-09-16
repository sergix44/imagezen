# `ellipse()`

```
->ellipse(int $width, int $height, int $x, int $y, Closure $callback): self
```
## Parameters

- `int $width`: 
- `int $height`: 
- `int $x`: 
- `int $y`: 
- `Closure $callback`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->ellipse(int $width, int $height, int $x, int $y, Closure $callback);

```
