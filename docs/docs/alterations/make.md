# `make()`

```
->make(GdImage|Imagick|string $image, [SergiX44\ImageZen\Backend $driver = SergiX44\ImageZen\Backend::GD]): self
```
## Parameters

- `GdImage|Imagick|string $image`: 
- `SergiX44\ImageZen\Backend $driver`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->make(GdImage|Imagick|string $image, [SergiX44\ImageZen\Backend $driver = SergiX44\ImageZen\Backend::GD]);

```
