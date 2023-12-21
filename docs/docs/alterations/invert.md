---
sidebar_position: 31
_modified_: false
---
# `invert()`

```php
->invert(): SergiX44\ImageZen\Image
```
Invert the colors of the image.

## Parameters

<i>This method has no parameters.</i>

## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->invert();

```
