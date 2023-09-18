---
sidebar_position: 19
_modified_: true
---

# `exif()`

```php
->exif([?string $key = null]): array|string|null
```

Retrieve the exif data from the image.

## Parameters

- `?string $key`: The key to retrieve or null to retrieve all

## Returns

`array|string|null`: The exif data or a single value if $key is set

## Example

```php
use SergiX44\ImageZen\Image;

$make = Image::make('path/to/image.jpg')
    ->exif('Make'); // retrieve the make of the camera, if available
    
$allExif = Image::make('path/to/image.jpg')->exif(); // retrieve all exif data
```
