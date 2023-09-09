<?php

use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Flip;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Image;
use SergiX44\ImageZen\Shapes\Circle;
use SergiX44\ImageZen\Shapes\Ellipse;

beforeEach()->skip(fn () => !extension_loaded('gd'), 'gd extension not loaded.');

it('can create an empty canvas', function () {
    $filename = 'empty_canvas';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png", 100);

    unlink($out);
});

it('can create an empty canvas with a color', function () {
    $filename = 'colored_canvas';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100, Color::fuchsia())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png", 100);

    unlink($out);
});

it('can blur an image', function ($file) {
    $filename = 'baboon_blur';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->blur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can heavy blur an image', function ($file) {
    $filename = 'baboon_heavy_blur';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->heavyBlur()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can blur an image with a custom amount', function ($file) {
    $filename = 'baboon_blur_50';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->blur(5)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can heavy blur an image with a custom amount', function ($file) {
    $filename = 'baboon_heavy_blur_50';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->heavyBlur(11)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can change brightness of an image', function ($file) {
    $filename = 'baboon_brightness_50';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->brightness(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can draw an ellipse', function () {
    $filename = 'ellipse_on_canvas';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100)
        ->ellipse(55, 20, 50, 50, function (Ellipse $draw) {
            $draw->background(Color::fuchsia())
                ->border(2, Color::green());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
});

it('can draw a circle', function () {
    $filename = 'circle_on_canvas';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100)
        ->circle(50, 50, 50, function (Circle $draw) {
            $draw->background(Color::black())
                ->border(2, Color::gold());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
});

it('can draw a circle on a image', function ($file) {
    $filename = 'circle_on_image';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->circle(50, 50, 50, function (Circle $draw) {
            $draw->background(Color::teal())
                ->border(2, Color::black());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can colorize an image', function ($file) {
    $filename = 'baboon_colorize';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->colorize(0, 0, 20)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");

    unlink($out);
})->with('baboon');

it('can change image contrast', function ($file) {
    $filename = 'baboon_contrast_50';
    $out = __DIR__."/Tmp/$filename.png";
    Image::make($file)
        ->contrast(50)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can crop an image', function ($file) {
    $filename = 'baboon_crop';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->crop(100, 100)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can fill a canvas with a color', function () {
    $filename = 'canvas_color_fill';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(100, 100)
        ->fill(Color::red())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
});

it('can fill a canvas with a image', function ($file) {
    $filename = 'canvas_image_fill';
    $out = __DIR__."/Tmp/$filename.png";

    Image::canvas(800, 800)
        ->fill(Image::make($file))
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can fill an image with a color', function ($file) {
    $filename = 'image_color_fill';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->fill(Color::teal(), 9, 9)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('tile');

it('can fit an image into another', function ($file) {
    $filename = 'baboon_fit';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->fit(500, 1000, position: Position::BOTTOM_RIGHT)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can flip an image', function ($file) {
    $filename = 'baboon_flip';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->flip(Flip::VERTICAL)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can change the gamma of an image', function ($file) {
    $filename = 'baboon_gamma_02';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->gamma(0.2)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can change an image to greyscale', function ($file) {
    $filename = 'baboon_greyscale';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->greyscale()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can heighten an image', function ($file) {
    $filename = 'fruit_heighten';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->heighten(200)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('fruit');

it('can insert an image on top of another', function ($file, $file2) {
    $filename = 'fruit_with_baboon';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->insert(Image::make($file2))
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('fruit', 'baboon');

it('can interlace an image', function ($file) {
    $filename = 'fruit_interlace';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
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
})->with('fruit');

it('can invert an image', function ($file) {
    $filename = 'baboon_inverted';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->invert()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can limit colors of an image', function ($file) {
    $filename = 'baboon_color_limited';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->limitColors(4)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can draw a line on an image', function ($file) {
    $filename = 'baboon_with_line';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->line(10, 10, 100, 100, function ($draw) {
            $draw->color(Color::fuchsia());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can change a pixel an image', function ($file) {
    $filename = 'tile_with_pixel';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->pixel(Color::fuchsia(), 10, 10)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('tile');

it('can mask an image with of another', function ($file, $file2) {
    $filename = 'fruit_with_baboon_mask';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->mask(Image::make($file2), false)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon', 'fruit');

it('can get the mime of an image', function ($file) {
    $mime = Image::make($file)->mime();
    expect($mime)->toBe('image/png');
})->with('baboon');

it('can change the opacity an image', function ($file) {
    $filename = 'baboon_opacity_70';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->opacity(70)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can get the exif of an image', function ($file) {
    $exif = Image::make($file)->exif();

    expect($exif)->toBeArray();
    expect($exif['FileName'])->toBe('exif.jpg');
    expect($exif['FileSize'])->toBe(7791);
    expect($exif['FileType'])->toBe(2);
})->with('exif');

it('can pixelate an image', function ($file) {
    $filename = 'baboon_pixeled';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->pixelate(10)
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can draw a polygon on an image', function ($file) {
    $filename = 'baboon_polygon';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->polygon([
            10, 10,
            100, 100,
            10, 100,
        ], function ($draw) {
            $draw->background(Color::fuchsia());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can draw a rectangle on an image', function ($file) {
    $filename = 'baboon_rectangle';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->rectangle(10, 30, 100, 100, function ($draw) {
            $draw->background(Color::fuchsia());
        })
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can rotate an image', function ($file) {
    $filename = 'baboon_rotate';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->rotate(56, Color::fuchsia())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');

it('can resize canvas of an image small', function ($file) {
    $filename = 'fruit_resize_canvas_small';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->resizeCanvas(200, 200, Position::CENTER, false, Color::fuchsia())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('fruit');

it('can resize canvas of an image big', function ($file) {
    $filename = 'fruit_resize_canvas_big';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->resizeCanvas(800, 900, Position::CENTER, false, Color::fuchsia())
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('fruit');

it('can sharpen an image', function ($file) {
    $filename = 'baboon_sharpen';
    $out = __DIR__."/Tmp/$filename.png";

    Image::make($file)
        ->sharpen()
        ->save($out, quality: 100);

    expect($out)
        ->toBeFile()
        ->imageSimilarTo(__DIR__."/Images/Gd/$filename.png");
    unlink($out);
})->with('baboon');
