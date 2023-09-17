---
sidebar_position: 19
_modified_: false
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

$image = Image::make('path/to/image.jpg')
    ->exif([?string $key = null]);

```
