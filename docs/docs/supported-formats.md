---
sidebar_position: 2
---

# Supported Formats

ImageZen supports two backends: GD and Imagick.
Those are listed in the `SergiX44\ImageZen\Backend` enum.

- `Backend::GD`
- `Backend::IMAGICK`

The default backend is `Backend::GD`, but you can change it by setting the second parameter
of the `Image::make()` method or the `Image::canvas()` method.

```php
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Backend;

// by default is GD
$image = Image::make('path/to/image.jpg');
$image = Image::canvas(300, 200);

// -> same as
$image = Image::make('path/to/image.jpg', Backend::GD);
$image = Image::canvas(300, 200, Backend::GD);

// for imagick
$image = Image::make('path/to/image.jpg', Backend::IMAGICK);
$image = Image::canvas(300, 200, Backend::IMAGICK);
```

## Supported Formats

All the available formats are listed in the `SergiX44\ImageZen\Format` enum,
here is a list of them, and the supported backends:

| Format         | GD | Imagick |
|----------------|----|:-------:|
| `Format::PNG`  | ✔  |    ✔    |
| `Format::JPEG` | ✔  |    ✔    |
| `Format::WEBP` | ✔  |    ✔    |
| `Format::GIF`  | ✔  |    ✔    |
| `Format::BMP`  | ✔  |    ✔    |
| `Format::TIFF` | ❌  |    ✔    |
| `Format::HEIC` | ✔  |    ✔    |
| `Format::AVIF` | ✔  |    ✔    |

Imagick supports more formats than GD, but it's not available by default in most PHP installations.
It's also marginally faster than GD, but it's not noticeable in most cases.
