---
sidebar_position: 5
_modified_: false
---
# `filter()`

```php
->filter(SergiX44\ImageZen\Filter $filter): void
```
Apply a filter to the image.

## Parameters

- `SergiX44\ImageZen\Filter $filter`: 


## Returns

`void`, no return value.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->filter(SergiX44\ImageZen\Filter $filter);

```
