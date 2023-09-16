# `trim()`

```
->trim([SergiX44\ImageZen\Draws\TrimFrom $base = SergiX44\ImageZen\Draws\TrimFrom::TOP_LEFT], SergiX44\ImageZen\Draws\Position|array|null $away, [int $tolerance = 0], [int $feather = 0]): self
```
## Parameters

- `SergiX44\ImageZen\Draws\TrimFrom $base`: 
- `SergiX44\ImageZen\Draws\Position|array|null $away`: 
- `int $tolerance`: 
- `int $feather`: 


## Returns

Instance of `SergiX44\ImageZen\Image`.

## Example

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->trim([SergiX44\ImageZen\Draws\TrimFrom $base = SergiX44\ImageZen\Draws\TrimFrom::TOP_LEFT], SergiX44\ImageZen\Draws\Position|array|null $away, [int $tolerance = 0], [int $feather = 0]);

```
