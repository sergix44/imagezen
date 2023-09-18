---
sidebar_position: 21
_modified_: true
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

$filesize = Image::make('path/to/image.jpg')->filesize(); // filesize in bytes

```
