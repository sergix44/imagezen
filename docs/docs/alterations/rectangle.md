# `rectangle()`

```
->rectangle(int $x1, int $y1, int $x2, int $y2, Closure $callback): self
```
## Parameters

- `int $x1`: 
- `int $y1`: 
- `int $x2`: 
- `int $y2`: 
- `Closure $callback`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->rectangle(int $x1, int $y1, int $x2, int $y2, Closure $callback);

```
