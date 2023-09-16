# `resize()`

```
->resize(int $width, int $height, [?Closure $constraints = null]): self
```
## Parameters

- `int $width`: 
- `int $height`: 
- `?Closure $constraints`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->resize(int $width, int $height, [?Closure $constraints = null]);

```
