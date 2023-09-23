---
sidebar_position: 6
_modified_: true
---
# `filter()`

```php
->filter(SergiX44\ImageZen\Filter $filter): void
```
Apply a filter to the image.

See [Filters](/docs/extend#filters) for more information.

## Parameters

- `SergiX44\ImageZen\Filter $filter`: An instance of a class implementing the `SergiX44\ImageZen\Filter` interface.


## Returns

`void`, no return value.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->filter(new MyCustomFilter());

```
