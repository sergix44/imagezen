---
sidebar_position: 25
_modified_: false
---
# `greyscale()`

```php
->greyscale(): SergiX44\ImageZen\Image
```
Convert the image to grayscale.

## Parameters

<i>This method has no parameters.</i>

## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->greyscale();

```
