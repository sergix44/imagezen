---
sidebar_position: 23
_modified_: false
---
# `fit()`

```php
->fit(int $width, [?int $height = null], [?Closure $constraints = null], [SergiX44\ImageZen\Draws\Position $position = SergiX44\ImageZen\Draws\Position::CENTER]): SergiX44\ImageZen\Image
```
Fit the image into the given dimensions.

## Parameters

- `int $width`: The width to fit the image into
- `?int $height`: The height to fit the image into
- `?Closure $constraints`: A callback that is passed an instance of SergiX44\ImageZen\Constraints
- `SergiX44\ImageZen\Draws\Position $position`: The position where the image should be placed


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->fit(int $width, [?int $height = null], [?Closure $constraints = null], [SergiX44\ImageZen\Draws\Position $position = SergiX44\ImageZen\Draws\Position::CENTER]);

```
