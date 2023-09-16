<?php

namespace SergiX44\ImageZen\Getters;

use RuntimeException;
use SergiX44\ImageZen\Alteration;
use SergiX44\ImageZen\Drivers\Gd\GdAlteration;
use SergiX44\ImageZen\Drivers\Imagick\ImagickAlteration;
use SergiX44\ImageZen\Image;

class GetIptc extends Alteration implements GdAlteration, ImagickAlteration
{
    public static string $id = 'iptc';

    public function __construct(protected ?string $key = null)
    {
    }

    public function applyWithGd(Image $image): mixed
    {
        return $this->getIptc($image);
    }

    public function applyWithImagick(Image $image): mixed
    {
        return $this->getIptc($image);
    }

    /**
     * @param  Image  $image
     * @return array|false|mixed|null
     */
    private function getIptc(Image $image): mixed
    {
        if (!function_exists('iptcparse')) {
            throw new RuntimeException("Reading Iptc data is not supported by this PHP installation.");
        }

        $info = [];
        @getimagesize($image->basePath(), $info);

        $data = [];

        if (array_key_exists('APP13', $info)) {
            $iptc = iptcparse($info['APP13']);

            if (is_array($iptc)) {
                $data['DocumentTitle'] = $iptc["2#005"][0] ?? null;
                $data['Urgency'] = $iptc["2#010"][0] ?? null;
                $data['Category'] = $iptc["2#015"][0] ?? null;
                $data['Subcategories'] = $iptc["2#020"][0] ?? null;
                $data['Keywords'] = isset($iptc["2#025"][0]) ? $iptc["2#025"] : null;
                $data['ReleaseDate'] = $iptc["2#030"][0] ?? null;
                $data['ReleaseTime'] = $iptc["2#035"][0] ?? null;
                $data['SpecialInstructions'] = $iptc["2#040"][0] ?? null;
                $data['CreationDate'] = $iptc["2#055"][0] ?? null;
                $data['CreationTime'] = $iptc["2#060"][0] ?? null;
                $data['AuthorByline'] = $iptc["2#080"][0] ?? null;
                $data['AuthorTitle'] = $iptc["2#085"][0] ?? null;
                $data['City'] = $iptc["2#090"][0] ?? null;
                $data['SubLocation'] = $iptc["2#092"][0] ?? null;
                $data['State'] = $iptc["2#095"][0] ?? null;
                $data['Country'] = $iptc["2#101"][0] ?? null;
                $data['OTR'] = $iptc["2#103"][0] ?? null;
                $data['Headline'] = $iptc["2#105"][0] ?? null;
                $data['Source'] = $iptc["2#110"][0] ?? null;
                $data['PhotoSource'] = $iptc["2#115"][0] ?? null;
                $data['Copyright'] = $iptc["2#116"][0] ?? null;
                $data['Caption'] = $iptc["2#120"][0] ?? null;
                $data['CaptionWriter'] = $iptc["2#122"][0] ?? null;
            }
        }

        if ($this->key !== null && is_array($data)) {
            $data = array_key_exists($this->key, $data) ? $data[$this->key] : false;
        }

        return $data;
    }
}
