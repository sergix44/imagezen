<?php

namespace SergiX44\ImageZen\Drivers\Gd;

use InvalidArgumentException;
use SergiX44\ImageZen\Draws\Box;
use SergiX44\ImageZen\Draws\Size;
use SergiX44\ImageZen\Draws\Text;
use SergiX44\ImageZen\Shapes\Point;

class GdText extends Text
{
    protected ?int $internalFont = 5;

    public function font(?string $font): self
    {
        if (is_numeric($font)) {
            $ifont = (int) $font;
            if ($ifont < 1 || $ifont > 5) {
                throw new InvalidArgumentException('Invalid internal GD font number');
            }

            $this->internalFont = $ifont;

            return parent::font(null);
        }

        return parent::font($font);
    }

    public function getPointSize(): int
    {
        return (int) ceil($this->size * 0.75);
    }

    public function getBox(): Box
    {
        if (grapheme_strlen($this->text) === 0) {
            return new Box(new Point(), new Point(), new Point(), new Point());
        }

        if ($this->hasFont()) {
            $text = $this->parsedText();
            $box = imagettfbbox($this->getPointSize(), $this->angle, $this->fontPath, $text);

            return new Box(new Point($box[0], $box[1]), new Point($box[2], $box[3]), new Point($box[4], $box[5]), new Point($box[6], $box[7]));
        }

        $width = $this->internalFont + 4;
        $height = match ($this->internalFont) {
            1, 2, 3 => 14,
            4, 5 => 16,
            default => 8,
        };

        return (new Size(strlen($this->text) * $width, $height, new Point()))->getBox();
    }

    public function parsedText(): string
    {
        // imagettfbbox() converts numeric entities to their respective
        // character. Preserve any originally double encoded entities to be
        // represented as is.
        // eg: &amp;#160; will render &#160; rather than its character.
        $text = preg_replace('/&(#(?:x[a-fA-F0-9]+|[0-9]+);)/', '&#38;\1', $this->text);

        return mb_encode_numericentity($text, [0x0080, 0xffff, 0, 0xffff], 'UTF-8');
    }

    public function getInternalFont(): ?int
    {
        return $this->internalFont;
    }

    private function linebreaks4imagettftext(
        $size,
        $angle,
        $fontfile,
        $text,
        $maximumWidth,
        $lineBreakCharacter = PHP_EOL
    ): string {
        // create an array with all the words
        $words = explode(' ', $text);

        // process all our words to generate $textWithLineBreaks
        $textWithLineBreaks = '';
        $currentLine = '';
        foreach ($words as $position => $word) {
            // place the first word into $currentLine without any processing (we
            // always want to include the first word on the first line--obviously)
            if ($position === 0) {
                $currentLine = $word;
            } else {
                // calculate the text's size if we were to add the word
                $textDimensions = imagettfbbox(
                    $size,
                    $angle,
                    $fontfile,
                    $currentLine.' '.$word
                );
                $textLeft = min($textDimensions[0], $textDimensions[6]);
                $textRight = max($textDimensions[2], $textDimensions[4]);
                $textWidth = $textRight - $textLeft;
                if ($textWidth > $maximumWidth) {
                    // the text is too wide with the added word so we add a line
                    // break then start a new line with only the added word
                    $textWithLineBreaks .= $currentLine;
                    $textWithLineBreaks .= $lineBreakCharacter;

                    $currentLine = $word;
                } else {
                    // we have space on the current line for the added word so we
                    // add a space then the word
                    $currentLine .= ' ';
                    $currentLine .= $word;
                }
            }
        }
        // the current line is still unadded to $textWithLineBreaks so we add it
        $textWithLineBreaks .= $currentLine;

        // return $text with line breaks added
        return $textWithLineBreaks;
    }
}
