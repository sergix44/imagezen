---
sidebar_position: 2
_modified_: true
---
# `register()`

```php
->register(string ...$classes): self
```
Register a new alteration.

## Parameters

- `string $classes`: A class or a list of classes extending the Alteration base class.


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->register(MyGrayscale::class, MyBlur::class);

```
