---
sidebar_position: 3
---

# Extending

You can add your own filters, which is basically a collection of methods that you can apply to an image, or create
your own alterations, which is a single method that you can apply to an image.

## Filters

Filters are a collection of methods that you can apply to an image, a filter must implement the
`SergiX44\ImageZen\Filter`.

Here an example of a filter that adds a watermark to an image:

```php
use SergiX44\ImageZen\Filter;
use SergiX44\ImageZen\Image;

class BlurAndGrayscaleFilter implements Filter
{
    public function apply(Image $image): mixed
    {
        $image->blur(10)
        ->greyscale();
    }
}
```

Then you can apply it to an image:

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg')
    ->filter(new BlurAndGrayscaleFilter());
```

## Alterations

Alterations are a single method that you can apply to an image, an alteration must extend
the `SergiX44\ImageZen\Alteration`.
An alteration by itself is not useful, your need to implement the driver interface, which is the class that actually
applies the alteration to the image, using a specific backend.
The available driver interfaces are:

- `SergiX44\ImageZen\Drivers\Gd\GdAlteration`
- `SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration`

Here an example of how a `myInvert` alteration can be implemented:

```php
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class MyInvert extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'myInvert';
    
    public function __construct(public int $myParam)
    {
    }

    public function applyWithGd(Image $image): null
    {
        // do something with the image, for example:
        imagefilter($image->getCore(), IMG_FILTER_NEGATE);
        return null;
    }

    public function applyWithImagick(Image $image): null
    {
    // do something with the image, for example:
        $image->getCore()->negateImage(false, \Imagick::CHANNEL_ALL - \Imagick::CHANNEL_ALPHA);
        return null;
    }
}
```

You can just implement the driver interface that you need if you are not going to use the other one, is not mandatory
to implement both.

The $id property is used to identify the alteration, and must be unique, if you try to register an alteration with an
id that is already registered, an exception will be thrown.

Then you can apply it to an image, by calling the `->alterate()` method, or the magic method:

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg');

// register the alteration
$image->register(MyInvert::class);

// apply the alteration
$image->alterate('myInvert', 10);
// or
$image->myInvert(10);
    
```

All parameters are passed to the constructor of the alteration.
