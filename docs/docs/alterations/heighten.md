# `heighten()`

```
->heighten(int $height, [?Closure $callback = null]): self
```
## Parameters

- `int $height`: 
- `?Closure $callback`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->heighten(int $height, [?Closure $callback = null]);

```
