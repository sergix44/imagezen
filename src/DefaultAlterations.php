<?php

namespace SergiX44\ImageZen;

use Closure;
use SergiX44\ImageZen\Draws\Color;
use SergiX44\ImageZen\Draws\Flip;
use SergiX44\ImageZen\Draws\Position;
use SergiX44\ImageZen\Draws\TrimFrom;

trait DefaultAlterations
{
    protected function registerDefaultAlterations(): void
    {
        $this->register(Alterations\Blur::class);
        $this->register(Alterations\HeavyBlur::class);
        $this->register(Alterations\Brightness::class);
        $this->register(Alterations\EllipseShape::class);
        $this->register(Alterations\CircleShape::class);
        $this->register(Alterations\Colorize::class);
        $this->register(Alterations\Contrast::class);
        $this->register(Getters\GetWidth::class);
        $this->register(Getters\GetHeight::class);
        $this->register(Alterations\Crop::class);
        $this->register(Getters\GetExif::class);
        $this->register(Getters\GetFilesize::class);
        $this->register(Alterations\Fill::class);
        $this->register(Alterations\Fit::class);
        $this->register(Alterations\Flip::class);
        $this->register(Alterations\Gamma::class);
        $this->register(Alterations\GreyScale::class);
        $this->register(Alterations\Heighten::class);
        $this->register(Alterations\Insert::class);
        $this->register(Alterations\Interlace::class);
        $this->register(Alterations\Invert::class);
        $this->register(Getters\GetIptc::class);
        $this->register(Alterations\LimitColors::class);
        $this->register(Alterations\LineShape::class);
        $this->register(Alterations\Mask::class);
        $this->register(Getters\GetMime::class);
        $this->register(Alterations\Opacity::class);
        $this->register(Alterations\Orientate::class);
        $this->register(Getters\GetColor::class);
        $this->register(Alterations\Pixel::class);
        $this->register(Alterations\Pixelate::class);
        $this->register(Alterations\PolygonShape::class);
        $this->register(Alterations\RectangleShape::class);
        $this->register(Alterations\Resize::class);
        $this->register(Alterations\ResizeCanvas::class);
        $this->register(Alterations\Rotate::class);
        $this->register(Alterations\Sharpen::class);
        $this->register(Alterations\WriteText::class);
        $this->register(Alterations\Trim::class);
        $this->register(Alterations\Widen::class);
    }

    /**
     * Apply a blur effect to the image.
     *
     * @param int $amount The amount of blur to apply (1-100)
     * @return Image
     */
    public function blur(int $amount = 1): Image
    {
        $this->alterate(__FUNCTION__, $amount);

        return $this;
    }

    /**
     * Apply a heavy blur effect to the image.
     *
     * @param int $amount The amount of blur to apply (1-100)
     * @return Image
     */
    public function heavyBlur(int $amount = 10): Image
    {
        $this->alterate(__FUNCTION__, $amount);

        return $this;
    }

    /**
     * Changes the brightness of the image.
     *
     * @param int $level The amount of brightness to apply (-100 to 100)
     * @return Image
     */
    public function brightness(int $level = 0): Image
    {
        $this->alterate(__FUNCTION__, $level);

        return $this;
    }

    /**
     * Draw an ellipse shape on the image.
     *
     * @param int $width The width of the ellipse
     * @param int $height The height of the ellipse
     * @param int $x The x-coordinate of the center of the ellipse
     * @param int $y The y-coordinate of the center of the ellipse
     * @param Closure|null $callback A callback that is passed an instance of SergiX44\ImageZen\Shapes\Ellipse
     * @return Image
     */
    public function ellipse(int $width, int $height, int $x, int $y, ?Closure $callback = null): Image
    {
        $this->alterate(__FUNCTION__, $width, $height, $x, $y, $callback);

        return $this;
    }

    /**
     * Draw a circle shape on the image.
     *
     * @param int $radius The radius of the circle
     * @param int $x The x-coordinate of the center of the circle
     * @param int $y The y-coordinate of the center of the circle
     * @param Closure|null $callback A callback that is passed an instance of SergiX44\ImageZen\Shapes\Circle
     * @return Image
     */
    public function circle(int $radius, int $x, int $y, ?Closure $callback = null): Image
    {
        $this->alterate(__FUNCTION__, $radius, $x, $y, $callback);

        return $this;
    }

    /**
     * Alters the colors of the image using a colorize effect.
     *
     * @param int $red The amount of red (0 to 255)
     * @param int $green The amount of green (0 to 255)
     * @param int $blue The amount of blue (0 to 255)
     * @return Image
     */
    public function colorize(int $red, int $green, int $blue): Image
    {
        $this->alterate(__FUNCTION__, $red, $green, $blue);

        return $this;
    }

    /**
     * Changes the contrast of the image.
     *
     * @param int $level The amount of contrast to apply (-100 to 100)
     * @return Image
     */
    public function contrast(int $level): Image
    {
        $this->alterate(__FUNCTION__, $level);

        return $this;
    }

    /**
     * Crop the image to the given dimensions. If no x and y coordinates are given, the center of the image will be used.
     *
     * @param int $width The width of the crop
     * @param int $height The height of the crop
     * @param int|null $x The x-coordinate of the crop's center
     * @param int|null $y The y-coordinate of the crop's center
     * @return Image
     */
    public function crop(int $width, int $height, ?int $x = null, ?int $y = null): Image
    {
        $this->alterate(__FUNCTION__, $width, $height, $x, $y);

        return $this;
    }

    /**
     * Get the image width.
     *
     * @return int The image width
     */
    public function width(): int
    {
        return $this->alterate(__FUNCTION__);
    }

    /**
     * Get the image height.
     *
     * @return int The image height
     */
    public function height(): int
    {
        return $this->alterate(__FUNCTION__);
    }

    /**
     * Retrieve the exif data from the image.
     *
     * @param string|null $key The key to retrieve or null to retrieve all
     * @return array|string|null The exif data or a single value if $key is set
     */
    public function exif(?string $key = null): array|string|null
    {
        return $this->alterate(__FUNCTION__, $key);
    }

    /**
     * Get the image filesize in bytes.
     *
     * @return int The image size in bytes
     */
    public function filesize(): int
    {
        return $this->alterate(__FUNCTION__);
    }

    /**
     * Fill the image with a given color or image.
     *
     * @param Color|Image $filling The color or image to use for filling
     * @param int|null $x The x-coordinate of the top-left point
     * @param int|null $y The y-coordinate of the top-left point
     * @return Image
     */
    public function fill(Color|Image $filling, ?int $x = null, ?int $y = null): Image
    {
        $this->alterate(__FUNCTION__, $filling, $x, $y);

        return $this;
    }

    /**
     * Fit the image into the given dimensions.
     *
     * @param int $width The width to fit the image into
     * @param int|null $height The height to fit the image into
     * @param Closure|null $constraints A callback that is passed an instance of SergiX44\ImageZen\Constraints
     * @param Position $position The position where the image should be placed
     * @return Image
     */
    public function fit(
        int $width,
        int $height = null,
        ?Closure $constraints = null,
        Position $position = Position::CENTER
    ): Image {
        $this->alterate(__FUNCTION__, $width, $height, $constraints, $position);

        return $this;
    }

    /**
     * Flip the image along the horizontal or vertical axis.
     *
     * @param Flip $flip The direction to flip the image
     * @return Image
     */
    public function flip(Flip $flip = Flip::HORIZONTAL): Image
    {
        $this->alterate(__FUNCTION__, $flip);

        return $this;
    }

    /**
     * Apply a gamma correction to the image.
     *
     * @param float $correction The amount of gamma correction (0.1-9.99)
     * @return Image
     */
    public function gamma(float $correction): Image
    {
        $this->alterate(__FUNCTION__, $correction);

        return $this;
    }

    /**
     * Convert the image to grayscale.
     *
     * @return Image
     */
    public function greyscale(): Image
    {
        $this->alterate(__FUNCTION__);

        return $this;
    }

    /**
     * Heighten the image to the given height.
     *
     * @param int $height The height to heighten the image to
     * @param Closure|null $callback A callback that is passed an instance of SergiX44\ImageZen\Constraints
     * @return Image
     */
    public function heighten(int $height, Closure $callback = null): Image
    {
        $this->alterate(__FUNCTION__, $height, $callback);

        return $this;
    }

    /**
     * Insert another image on top of the current image.
     *
     * @param Image $image The image to insert
     * @param Position $position The position where the image should be placed
     * @param int|null $x The x-coordinate of the top-left point
     * @param int|null $y The y-coordinate of the top-left point
     * @return Image
     */
    public function insert(Image $image, Position $position = Position::CENTER, ?int $x = null, ?int $y = null): Image
    {
        $this->alterate(__FUNCTION__, $image, $position, $x, $y);

        return $this;
    }

    /**
     * Interlace the image.
     *
     * @param bool $interlace Whether to interlace the image or not
     * @return Image
     */
    public function interlace(bool $interlace = true): Image
    {
        $this->alterate(__FUNCTION__, $interlace);

        return $this;
    }

    /**
     * Invert the colors of the image.
     *
     * @return Image
     */
    public function invert(): Image
    {
        $this->alterate(__FUNCTION__);

        return $this;
    }

    /**
     * Retrieve the iptc data from the image.
     *
     * @param string|null $key The key to retrieve or null to retrieve all
     * @return array|string|null The iptc data or a single value if $key is set
     */
    public function iptc(?string $key = null): array|string|null
    {
        return $this->alterate(__FUNCTION__, $key);
    }

    /**
     * Limit the number of colors of the image.
     *
     * @param int $count The number of colors to limit the image to
     * @param Color|null $matte The color to use for non-opaque pixels
     * @return Image
     */
    public function limitColors(int $count, ?Color $matte = null): Image
    {
        $this->alterate(__FUNCTION__, $count, $matte);

        return $this;
    }

    /**
     * Draw a line shape on the image.
     *
     * @param int $x1 The x-coordinate of the first point
     * @param int $y1 The y-coordinate of the first point
     * @param int $x2 The x-coordinate of the second point
     * @param int $y2 The y-coordinate of the second point
     * @param Closure|null $callback A callback that is passed an instance of SergiX44\ImageZen\Shapes\Line
     * @return Image
     */
    public function line(int $x1, int $y1, int $x2, int $y2, ?Closure $callback = null): Image
    {
        $this->alterate(__FUNCTION__, $x1, $y1, $x2, $y2, $callback);

        return $this;
    }

    /**
     * Apply a mask to the image.
     *
     * @param Image $mask The image to use as a mask
     * @param bool $withAlpha Whether to apply the alpha channel or not
     * @return Image
     */
    public function mask(Image $mask, bool $withAlpha): Image
    {
        $this->alterate(__FUNCTION__, $mask, $withAlpha);

        return $this;
    }

    /**
     * Get the image mime type.
     *
     * @return string The image mime type
     */
    public function mime(): string
    {
        return $this->alterate(__FUNCTION__);
    }

    /**
     * Change the opacity of the image.
     *
     * @param int $transparency The opacity level (0-100)
     * @return Image
     */
    public function opacity(int $transparency): Image
    {
        $this->alterate(__FUNCTION__, $transparency);

        return $this;
    }

    /**
     * Get text color at a given position.
     * @param int $x The x-coordinate of the position
     * @param int $y The y-coordinate of the position
     * @return Color The color at the given position
     */
    public function pickColor(int $x, int $y): Color
    {
        return $this->alterate(__FUNCTION__, $x, $y);
    }

    /**
     * Change color of a single pixel.
     *
     * @param Color $color The color to use
     * @param int $x The x-coordinate of the pixel
     * @param int $y The y-coordinate of the pixel
     * @return Image
     */
    public function pixel(Color $color, int $x, int $y): Image
    {
        $this->alterate(__FUNCTION__, $color, $x, $y);

        return $this;
    }

    /**
     * Pixelate a given part of the image.
     *
     * @param int $size The amount of pixelation
     * @return Image
     */
    public function pixelate(int $size): Image
    {
        $this->alterate(__FUNCTION__, $size);

        return $this;
    }

    /**
     * Draw a polygon shape on the image.
     *
     * @param array $points The points of the polygon
     * @param Closure|null $callback A callback that is passed an instance of SergiX44\ImageZen\Shapes\Polygon
     * @return Image
     */
    public function polygon(array $points, ?Closure $callback = null): Image
    {
        $this->alterate(__FUNCTION__, $points, $callback);

        return $this;
    }

    /**
     * Draw a rectangle shape on the image.
     *
     * @param int $x1 The x-coordinate of the top-left point
     * @param int $y1 The y-coordinate of the top-left point
     * @param int $x2 The x-coordinate of the bottom-right point
     * @param int $y2 The y-coordinate of the bottom-right point
     * @param Closure|null $callback A callback that is passed an instance of SergiX44\ImageZen\Shapes\Rectangle
     * @return Image
     */
    public function rectangle(int $x1, int $y1, int $x2, int $y2, ?Closure $callback = null): Image
    {
        $this->alterate(__FUNCTION__, $x1, $y1, $x2, $y2, $callback);

        return $this;
    }

    /**
     * Resizes current image based on given width and/or height. To constraint the resize command, pass an optional Closure callback as third parameter.
     *
     * @param int|null $width The width to resize the image to
     * @param int|null $height The height to resize the image to
     * @param Closure|null $constraints A callback that is passed an instance of SergiX44\ImageZen\Constraints
     * @return Image
     */
    public function resize(?int $width = null, ?int $height = null, ?Closure $constraints = null): Image
    {
        $this->alterate(__FUNCTION__, $width, $height, $constraints);

        return $this;
    }

    /**
     * Resize the boundaries of the current image to given width and height. An anchor can be defined to determine from what point of the image the resizing is going to happen. Set the mode to relative to add or subtract the given width or height to the actual image dimensions. You can also pass a background color for the emerging area of the image.
     *
     * @param int|null $width The width to resize the image to
     * @param int|null $height The height to resize the image to
     * @param Position $anchor The anchor point of the resize operation
     * @param bool $relative Whether to use relative dimensions or not
     * @param Color|null $background The background color to use for the uncovered area
     * @return Image
     */
    public function resizeCanvas(
        ?int $width,
        ?int $height,
        Position $anchor = Position::CENTER,
        bool $relative = false,
        Color $background = null
    ): Image {
        $this->alterate(__FUNCTION__, $width, $height, $anchor, $relative, $background ?? Color::transparent());

        return $this;
    }

    /**
     * Rotate the image by a given number of degrees.
     *
     * @param float $angle The number of degrees to rotate the image by
     * @param Color|null $background The background color to use for the uncovered area, default is transparent
     * @return Image
     */
    public function rotate(float $angle, ?Color $background = null): Image
    {
        $this->alterate(__FUNCTION__, $angle, $background ?? Color::transparent());

        return $this;
    }

    /**
     * Sharpen the image.
     *
     * @param int $amount The amount of sharpening (1-100)
     * @return Image
     */
    public function sharpen(int $amount = 10): Image
    {
        $this->alterate(__FUNCTION__, $amount);

        return $this;
    }

    /**
     * Write text to the image.
     *
     * @param string $text The text to write to the image
     * @param int $x The x-coordinate of the text
     * @param int $y The y-coordinate of the text
     * @param Closure|null $callback A callback that is passed an instance of SergiX44\ImageZen\Fonts\Font
     * @return Image
     */
    public function text(string $text, int $x, int $y, ?Closure $callback = null): Image
    {
        $this->alterate(__FUNCTION__, $text, $x, $y, $callback);

        return $this;
    }

    /**
     * Trim away image space on a given side.
     *
     * @param TrimFrom $base The side to trim away, default is top left
     * @param Position|array|null $away The sides to trim away, default is all sides
     * @param int $tolerance The tolerance in pixels
     * @param int $feather The feather in pixels
     * @return Image
     */
    public function trim(
        TrimFrom $base = TrimFrom::TOP_LEFT,
        Position|array|null $away = null,
        int $tolerance = 0,
        int $feather = 0
    ): Image {
        if (!is_array($away)) {
            $away = $away !== null ? [$away] : [Position::TOP, Position::RIGHT, Position::BOTTOM, Position::LEFT];
        }

        $this->alterate(__FUNCTION__, $base, $away, $tolerance, $feather);

        return $this;
    }

    /**
     * Widen the image to the given width.
     *
     * @param int $width The width to widen the image to
     * @param Closure|null $callback A callback that is passed an instance of SergiX44\ImageZen\Constraints
     * @return Image
     */
    public function widen(int $width, ?Closure $callback = null): Image
    {
        $this->alterate(__FUNCTION__, $width, $callback);

        return $this;
    }
}
