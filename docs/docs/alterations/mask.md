# `mask()`

```
->mask(SergiX44\ImageZen\Image $mask, bool $withAlpha): self
```
## Parameters

- `SergiX44\ImageZen\Image $mask`: 
- `bool $withAlpha`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->mask(SergiX44\ImageZen\Image $mask, bool $withAlpha);

```
