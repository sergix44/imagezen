---
sidebar_position: 47
_modified_: true
---
# `trim()`

```php
->trim([SergiX44\ImageZen\Draws\TrimFrom $base = SergiX44\ImageZen\Draws\TrimFrom::TOP_LEFT], SergiX44\ImageZen\Draws\Position|array|null $away, [int $tolerance = 0], [int $feather = 0]): SergiX44\ImageZen\Image
```
Trim away image space on a given side.

## Parameters

- `SergiX44\ImageZen\Draws\TrimFrom $base`: The side to trim away, default is top left
- `SergiX44\ImageZen\Draws\Position|array|null $away`: The sides to trim away, default is all sides
- `int $tolerance`: The tolerance in pixels
- `int $feather`: The feather in pixels


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->trim(); // trim away all sides

$image = Image::make('path/to/image.jpg')
    ->trim(SergiX44\ImageZen\Draws\TrimFrom::TOP_LEFT); // trim away top left

```
