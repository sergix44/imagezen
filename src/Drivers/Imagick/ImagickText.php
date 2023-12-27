<?php

namespace SergiX44\ImageZen\Drivers\Imagick;

use SergiX44\ImageZen\Draws\Box;
use SergiX44\ImageZen\Draws\Size;
use SergiX44\ImageZen\Draws\Text;
use SergiX44\ImageZen\Shapes\Point;

class ImagickText extends Text
{
    public float $kerning = 0.0;

    public function kerning(float $kerning): self
    {
        $this->kerning = $kerning;

        return $this;
    }

    public function getBox(): Box
    {
        $draw = new \ImagickDraw();
        $draw->setFont($this->fontPath);
        $draw->setFontSize($this->size);
        $draw->setTextKerning($this->kerning);
        $draw->setGravity($this->align->toImagickGravity());
        if ($this->stroke !== null) {
            $draw->setStrokeWidth($this->stroke);
        }
        $draw->setStrokeAntialias(false);
        $draw->setStrokeOpacity(1);
        $draw->setFillOpacity(1);
        $draw->setTextAntialias(true);
        $draw->setTextEncoding('UTF-8');

        $im = new \Imagick();
        $metrics = $im->queryFontMetrics($draw, $this->text);
        $im->destroy();

        return (new Size($metrics['textWidth'], $metrics['textHeight'], new Point()))->getBox();
    }
}
