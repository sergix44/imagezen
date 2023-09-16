# `colorize()`

```
->colorize(int $red, int $green, int $blue): self
```
## Parameters

- `int $red`: 
- `int $green`: 
- `int $blue`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->colorize(int $red, int $green, int $blue);

```
