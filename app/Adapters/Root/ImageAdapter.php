<?php

namespace App\Adapters\Root;

use App\Contracts\Root\ImageContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class ImageAdapter implements ImageContract
{
    protected $url;
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getWidth(): ?int
    {
        return null;
    }

    public function getHeight(): ?int
    {
        return null;
    }

    public function getColors(): ?Collection
    {
        return Cache::rememberForever(sprintf('%s_colors', $this->getUrl()), function () {
            $colorPalette = Palette::fromFilename($this->getUrl());
            // an extractor is built from a palette
            $extractor = new ColorExtractor($colorPalette);

            // it defines an extract method which return the most “representative” colors
            $colors = $extractor->extract(5);
            return collect($colors)->transform(function ($color) {
                return Color::fromIntToHex($color);
            });
        });
    }
}
