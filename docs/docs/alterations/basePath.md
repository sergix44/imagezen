---
sidebar_position: 4
_modified_: true
---
# `basePath()`

```php
->basePath(): string
```
Get the image path if it was loaded from a file.

## Parameters

<i>This method has no parameters.</i>

## Returns

`string`: The image path.

## Example

```php
use SergiX44\ImageZen\Image;

$path = Image::make('path/to/image.jpg')->basePath();

```
