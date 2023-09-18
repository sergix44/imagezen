---
sidebar_position: 1
---

# Getting Started

## Why ImageZen?

ImageZen is a PHP image manipulation library that is designed to be simple and easy to use. It's built to be fast and
lightweight, and it's focused on doing one thing and doing it well: image manipulation.

ImageZen is a refactored fork of the popular [Intervention Image](https://github.com/intervention/image) library, it's
fully compatible with PHP 8 and named arguments. It also has some new features and improvements.

- **Driver Switch**: You can easily switch between GD and Imagick drivers, ImageZen will take care of converting from
  one to another. See [Driver Switching](/docs/supported-formats#switching-backends-on-the-fly) for more information.
- **Extensible**: ImageZen is designed to be extended and customised, so you can easily add your own image manipulation
  functionality. See [Extend](/docs/extend) for more information.
- **Fast**: Some alteration has been refactored to be faster than the original library.
- **Strict Types**: ImageZen is fully typed, and leverages Enums and Named Arguments to make the API more readable and
  easy to use.
- **Tested**: ImageZen is fully tested and output images are compared to reference images to ensure that the output is
  correct and consistent.

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
