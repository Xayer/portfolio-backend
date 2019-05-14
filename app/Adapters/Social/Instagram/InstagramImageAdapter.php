<?php

namespace App\Adapters\Social\Instagram;

use App\Contracts\Root\ImageContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use League\ColorExtractor\Palette;

class InstagramImageAdapter implements ImageContract
{
    private $image;
    public function __construct($image)
    {
        $this->image = $image;
    }

    public function getUrl(): string
    {
        return $this->image->url;
    }

    public function getWidth(): ?int
    {
        return $this->image->width;
    }

    public function getHeight(): ?int
    {
        return $this->image->height;
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
