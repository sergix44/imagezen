---
sidebar_position: 24
_modified_: false
---
# `gamma()`

```php
->gamma(float $correction): SergiX44\ImageZen\Image
```
Apply a gamma correction to the image.

## Parameters

- `float $correction`: The amount of gamma correction (0.1-9.99)


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->gamma(float $correction);

```
