---
sidebar_position: 30
_modified_: false
---
# `iptc()`

```php
->iptc([?string $key = null]): array|string|null
```
Retrieve the iptc data from the image.

## Parameters

- `?string $key`: The key to retrieve or null to retrieve all


## Returns

`array|string|null`: The iptc data or a single value if $key is set

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->iptc([?string $key = null]);

```
