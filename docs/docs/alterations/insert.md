---
sidebar_position: 28
_modified_: false
---
# `insert()`

```php
->insert(SergiX44\ImageZen\Image $image, [SergiX44\ImageZen\Draws\Position $position = SergiX44\ImageZen\Draws\Position::CENTER], [?int $x = null], [?int $y = null]): SergiX44\ImageZen\Image
```
Insert another image on top of the current image.

## Parameters

- `SergiX44\ImageZen\Image $image`: The image to insert
- `SergiX44\ImageZen\Draws\Position $position`: The position where the image should be placed
- `?int $x`: The x-coordinate of the top-left point
- `?int $y`: The y-coordinate of the top-left point


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->insert(SergiX44\ImageZen\Image $image, [SergiX44\ImageZen\Draws\Position $position = SergiX44\ImageZen\Draws\Position::CENTER], [?int $x = null], [?int $y = null]);

```
