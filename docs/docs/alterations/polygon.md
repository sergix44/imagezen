# `polygon()`

```
->polygon(array $points, Closure $callback): self
```
## Parameters

- `array $points`: 
- `Closure $callback`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->polygon(array $points, Closure $callback);

```
