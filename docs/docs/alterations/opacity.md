---
sidebar_position: 36
_modified_: true
---
# `opacity()`

```php
->opacity(int $transparency): SergiX44\ImageZen\Image
```
Change the opacity of the image.

## Parameters

- `int $transparency`: The opacity level (0-100)


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->opacity(50); // set the opacity to 50%

```
