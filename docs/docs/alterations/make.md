---
sidebar_position: 0
_modified_: false
---
# `make()`

```php
->make(GdImage|Imagick|string $image, [SergiX44\ImageZen\Backend $driver = SergiX44\ImageZen\Backend::GD]): self
```
Initialize a new Image instance from a file path or a resource.

## Parameters

- `GdImage|Imagick|string $image`: The image path or resource.
- `SergiX44\ImageZen\Backend $driver`: The backend to use, default is GD.


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->make(GdImage|Imagick|string $image, [SergiX44\ImageZen\Backend $driver = SergiX44\ImageZen\Backend::GD]);

```
