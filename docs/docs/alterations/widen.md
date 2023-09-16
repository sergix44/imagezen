# `widen()`

```
->widen(int $width, [?Closure $callback = null]): self
```
## Parameters

- `int $width`: 
- `?Closure $callback`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->widen(int $width, [?Closure $callback = null]);

```
