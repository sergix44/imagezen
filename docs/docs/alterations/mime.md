---
sidebar_position: 35
_modified_: true
---
# `mime()`

```php
->mime(): string
```
Get the image mime type.

## Parameters

<i>This method has no parameters.</i>

## Returns

`string`: The image mime type

## Example

```php
use SergiX44\ImageZen\Image;

$mime = Image::make('path/to/image.jpg')->mime();

```
