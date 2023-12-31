---
sidebar_position: 31
_modified_: true
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

$ipcArray = Image::make('path/to/image.jpg')
    ->iptc(); // retrieve all iptc data
    
$ipcValue = Image::make('path/to/image.jpg')
    ->iptc('ObjectName'); // retrieve the ObjectName iptc value

```
