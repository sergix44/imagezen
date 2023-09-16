# `sharpen()`

```
->sharpen([int $amount = 10]): self
```
## Parameters

- `int $amount`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->sharpen([int $amount = 10]);

```
