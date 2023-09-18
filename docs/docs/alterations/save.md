---
sidebar_position: 7
_modified_: false
---
# `save()`

```php
->save(string $path, [SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]): bool
```
Save the image to a file.

## Parameters

- `string $path`: The file path.
- `SergiX44\ImageZen\Format $format`: The image format, default is PNG.
- `int $quality`: The image quality, default is 90, if supported by the format.


## Returns

`bool`: True if the image was saved successfully, false otherwise.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->save(string $path, [SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]);

```
