# `filter()`

```
->filter(SergiX44\ImageZen\Filter $filter): void
```
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
