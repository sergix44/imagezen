# `flip()`

```
->flip([SergiX44\ImageZen\Draws\Flip $flip = SergiX44\ImageZen\Draws\Flip::HORIZONTAL]): self
```
## Parameters

- `SergiX44\ImageZen\Draws\Flip $flip`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->flip([SergiX44\ImageZen\Draws\Flip $flip = SergiX44\ImageZen\Draws\Flip::HORIZONTAL]);

```
