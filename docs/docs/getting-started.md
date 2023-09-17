---
sidebar_position: 1
---

# Getting Started

## Installation

Install the package from Composer:

```bash
composer require sergix44/imagezen
```

:::info
ImageZen requires PHP 8.2 or higher.
:::

## Basic Usage

Basically all you need to do is to create an instance of the `Image` class:

```php
use SergiX44\ImageZen\Image;

$image = Image::make('path/to/image.jpg');
```

Basically almost every method call returns the same instance, so you can chain them:

```php

use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Format;

$image = Image::make('path/to/image.jpg')
    ->resize(300, 200)
    ->greyscale()
    ->blur(10);
    
$image->save('path/to/destination.png', Format::PNG);
$mime = $image->mime();
```

You can see all the available methods in the [API Reference](/docs/category/available-methods).

## Colors

ImageZen supports different color formats as input, managed by the `SergiX44\ImageZen\Color` class, here an example:
They gets automatically converted to the backend format, so you don't have to worry about it.

```php
use SergiX44\ImageZen\Draws\Color;

$color = Color::from('#ff0000');
$color = Color::from('#f00');

$color = Color::rgb(255, 0, 0);
$color= Color::rgba(255, 0, 0, 0.5);


// has also a variety of built-in colors
$color = Color::transparent();
$color = Color::black();
$color = Color::white();
$color = Color::red();
// ...

```
