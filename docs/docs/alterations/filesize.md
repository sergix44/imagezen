---
sidebar_position: 20
_modified_: false
---
# `filesize()`

```php
->filesize(): int
```
Get the image filesize in bytes.

## Parameters

<i>This method has no parameters.</i>

## Returns

`int`: The image size in bytes

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->filesize();

```
