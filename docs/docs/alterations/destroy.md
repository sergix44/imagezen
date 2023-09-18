---
sidebar_position: 48
_modified_: true
---
# `destroy()`

```php
->destroy(): void
```
Clear the image from memory, after this the image is no longer usable.

## Parameters

<i>This method has no parameters.</i>

## Returns

`void`, no return value.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->destroy();
// $image is no longer usable

```
