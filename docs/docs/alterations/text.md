# `text()`

```
->text(string $text, int $x, int $y, [?Closure $callback = null]): self
```
## Parameters

- `string $text`: 
- `int $x`: 
- `int $y`: 
- `?Closure $callback`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->text(string $text, int $x, int $y, [?Closure $callback = null]);

```
