# `circle()`

```
->circle(int $radius, int $x, int $y, Closure $callback): self
```
## Parameters

- `int $radius`: 
- `int $x`: 
- `int $y`: 
- `Closure $callback`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->circle(int $radius, int $x, int $y, Closure $callback);

```
