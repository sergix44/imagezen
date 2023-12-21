---
sidebar_position: 7
_modified_: true
---
# `save()`

```php
->save(string $path, [SergiX44\ImageZen\Format $format = SergiX44\ImageZen\Format::PNG], [int $quality = 90]): bool
```
Save the image to a file.

See [Supported Formats](/docs/supported-formats#supported-formats-1) for a list of supported formats.

## Parameters

- `string $path`: The file path.
- `SergiX44\ImageZen\Format $format`: The image format, default is PNG.
- `int $quality`: The image quality, default is 90, if supported by the format.


## Returns

`bool`: True if the image was saved successfully, false otherwise.

## Example

```php
use SergiX44\ImageZen\Image;

$success = Image::make('path/to/image.jpg')
    ->save('path/to/image.png', \SergiX44\ImageZen\Format::PNG); // save the image as PNG
    
$success = Image::make('path/to/image.jpg')
    ->save('path/to/image.png', \SergiX44\ImageZen\Format::JPG, 50); // save the image as JPG with a quality of 50

```
