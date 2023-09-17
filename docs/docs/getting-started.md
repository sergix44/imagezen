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
