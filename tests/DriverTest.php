<?php

use SergiX44\ImageZen\Backend;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Flip;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Draws\Text;
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Shapes\Circle;
use SergiX44\ImageZen\Shapes\Ellipse;

function prepare($instance, string $name, Backend $driver, string $ext = 'png'): array
{
    if (!$driver->getDriver()->isAvailable()) {
        $instance->markTestSkipped("{$driver->name()} is not available.");
    }

    $out = __DIR__ . "/Tmp/{$driver->name()}/$name.$ext";
    $expected = __DIR__ . "/Images/{$driver->name()}/$name.$ext";

    return [$out, $expected];
}

it('can create an empty canvas', function ($driver) {
    [$out, $expected] = prepare($this, 'empty_canvas', $driver);

    Image::canvas(100, 100, backend: $driver)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected, 100);

    unlink($out);
})->with('drivers');

it('can create an empty canvas with a color', function ($driver) {
    [$out, $expected] = prepare($this, 'colored_canvas', $driver);

    Image::canvas(100, 100, Color::fuchsia(), $driver)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected, 100);

    unlink($out);
})->with('drivers');

it('can blur an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_blur', $driver);

    Image::make($file, $driver)
        ->blur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers', 'baboon');

it('can heavy blur an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_heavy_blur', $driver);

    Image::make($file, $driver)
        ->heavyBlur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers', 'baboon');

it('can blur an image with a custom amount', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_blur_50', $driver);
    Image::make($file, $driver)
        ->blur(5)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers', 'baboon');

it('can heavy blur an image with a custom amount', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_heavy_blur_11', $driver);
    Image::make($file, $driver)
        ->heavyBlur(11)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers', 'baboon');

it('can change brightness of an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_brightness_50', $driver);
    Image::make($file, $driver)
        ->brightness(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers', 'baboon');

it('can draw an ellipse', function ($driver) {
    [$out, $expected] = prepare($this, 'ellipse_on_canvas', $driver);

    Image::canvas(100, 100, backend: $driver)
        ->ellipse(55, 20, 50, 50, function (Ellipse $draw) {
            $draw->background(Color::fuchsia())
                ->border(2, Color::green());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers');

it('can draw a circle', function ($driver) {
    [$out, $expected] = prepare($this, 'circle_on_canvas', $driver);

    Image::canvas(100, 100, backend: $driver)
        ->circle(50, 50, 50, function (Circle $draw) {
            $draw->background(Color::black())
                ->border(2, Color::gold());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers');

it('can draw a circle on a image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'circle_on_image', $driver);

    Image::make($file, $driver)
        ->circle(50, 50, 50, function (Circle $draw) {
            $draw->background(Color::teal())
                ->border(2, Color::black());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers', 'baboon');

it('can colorize an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_colorize', $driver);

    Image::make($file, $driver)
        ->colorize(0, 0, 20)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);

    unlink($out);
})->with('drivers', 'baboon');

it('can change image contrast', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_contrast_50', $driver);

    Image::make($file, $driver)
        ->contrast(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can crop an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_crop', $driver);

    Image::make($file, $driver)
        ->crop(100, 100)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can fill a canvas with a color', function ($driver) {
    [$out, $expected] = prepare($this, 'canvas_color_fill', $driver);

    Image::canvas(100, 100, backend: $driver)
        ->fill(Color::red())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers');

it('can fill a canvas with a image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'canvas_image_fill', $driver);

    Image::canvas(800, 800, backend: $driver)
        ->fill(Image::make($file, $driver))
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can fill an image with a color', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'image_color_fill', $driver);

    Image::make($file, $driver)
        ->fill(Color::teal(), 9, 9)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'tile');

it('can fit an image into another', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_fit', $driver);

    Image::make($file, $driver)
        ->fit(500, 1000, position: Position::BOTTOM_RIGHT)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can flip an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_flip', $driver);

    Image::make($file, $driver)
        ->flip(Flip::VERTICAL)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can change the gamma of an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_gamma_02', $driver);

    Image::make($file, $driver)
        ->gamma(0.2)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can change an image to greyscale', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_greyscale', $driver);

    Image::make($file, $driver)
        ->greyscale()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can heighten an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'fruit_heighten', $driver);

    Image::make($file, $driver)
        ->heighten(200)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'fruit');

it('can widen an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'fruit_widen', $driver);

    Image::make($file, $driver)
        ->widen(200)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'fruit');

it('can insert an image on top of another', function ($driver, $file, $file2) {
    [$out, $expected] = prepare($this, 'fruit_with_baboon', $driver);

    Image::make($file, $driver)
        ->insert(Image::make($file2))
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'fruit', 'baboon');

it('can interlace an image', function ($driver, $file) {
    [$out,] = prepare($this, 'fruit_interlace', $driver);

    Image::make($file, $driver)
        ->interlace()
        ->save($out, quality: 100);


    $handle = fopen($out, 'rb');
    $contents = fread($handle, 32);
    fclose($handle);
    $isInterlaced = ord($contents[28]) !== 0;

    expect($out)
        ->toBeFile()
        ->and($isInterlaced)->toBeTrue();

    unlink($out);
})->with('drivers', 'fruit');

it('can invert an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_inverted', $driver);

    Image::make($file, $driver)
        ->invert()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can limit colors of an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_color_limited', $driver);

    Image::make($file, $driver)
        ->limitColors(4)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can draw a line on an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_with_line', $driver);

    Image::make($file, $driver)
        ->line(10, 10, 100, 100, function ($draw) {
            $draw->color(Color::fuchsia());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can change a pixel an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'tile_with_pixel', $driver);

    Image::make($file, $driver)
        ->pixel(Color::fuchsia(), 10, 10)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'tile');

it('can mask an image with of another', function ($driver, $file, $file2) {
    [$out, $expected] = prepare($this, 'fruit_with_baboon_mask', $driver);

    Image::make($file, $driver)
        ->mask(Image::make($file2, $driver), false)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon', 'fruit');

it('can get the mime of an image', function ($driver, $file) {
    prepare($this, '_', $driver);
    $mime = Image::make($file, $driver)->mime();
    expect($mime)->toBe('image/png');
})->with('drivers', 'baboon');

it('can change the opacity an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_opacity_70', $driver);

    Image::make($file, $driver)
        ->opacity(70)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can get the exif of an image', function ($driver, $file) {
    $exif = Image::make($file, $driver)->exif();

    expect($exif)->toBeArray();
    expect($exif['FileName'])->toBe('exif.jpg');
    expect($exif['FileSize'])->toBe(7791);
    expect($exif['FileType'])->toBe(2);
})->with('drivers', 'exif');

it('can pixelate an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_pixeled', $driver);

    Image::make($file, $driver)
        ->pixelate(10)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can draw a polygon on an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_polygon', $driver);

    Image::make($file, $driver)
        ->polygon([
            10,
            10,
            100,
            100,
            10,
            100,
        ], function ($draw) {
            $draw->background(Color::fuchsia());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can draw a rectangle on an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_rectangle', $driver);

    Image::make($file, $driver)
        ->rectangle(10, 30, 100, 100, function ($draw) {
            $draw->background(Color::fuchsia());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can rotate an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_rotate', $driver);

    Image::make($file, $driver)
        ->rotate(56, Color::fuchsia())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected, 98);
    unlink($out);
})->with('drivers', 'baboon');

it('can resize canvas of an image small', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'fruit_resize_canvas_small', $driver);

    Image::make($file, $driver)
        ->resizeCanvas(200, 200, Position::CENTER, false, Color::fuchsia())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'fruit');

it('can resize canvas of an image big', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'fruit_resize_canvas_big', $driver);

    Image::make($file, $driver)
        ->resizeCanvas(800, 900, Position::CENTER, false, Color::fuchsia())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'fruit');

it('can sharpen an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'baboon_sharpen', $driver);

    Image::make($file, $driver)
        ->sharpen()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'baboon');

it('can write text on image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'fruit_base_text', $driver);

    Image::make($file, $driver)
        ->text('Hello World!', 100, 100, function (Text $text) {
            $text->font(5);
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'fruit');

it('can write text ttf on image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'fruit_base_text_ttf', $driver);

    Image::make($file, $driver)
        ->text('Hello World!', 100, 200, function (Text $text) {
            $text->angle(-30)
                ->color(Color::gold())
                ->font(__DIR__ . '/Images/arial.ttf')
                ->size(24);
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'fruit');

it('can trim an image', function ($driver, $file) {
    [$out, $expected] = prepare($this, 'fruit_trim_tolerance_80', $driver);

    Image::make($file, $driver)
        ->trim(tolerance: 80)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo($expected);
    unlink($out);
})->with('drivers', 'fruit');
