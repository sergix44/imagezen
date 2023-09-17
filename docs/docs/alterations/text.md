---
sidebar_position: 45
_modified_: false
---
# `text()`

```php
->text(string $text, int $x, int $y, [?Closure $callback = null]): SergiX44\ImageZen\Image
```
Write text to the image.

## Parameters

- `string $text`: The text to write to the image
- `int $x`: The x-coordinate of the text
- `int $y`: The y-coordinate of the text
- `?Closure $callback`: A callback that is passed an instance of SergiX44\ImageZen\Fonts\Font


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->text(string $text, int $x, int $y, [?Closure $callback = null]);

```
