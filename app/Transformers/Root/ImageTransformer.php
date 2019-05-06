<?php

namespace App\Transformers\Root;

use App\Adapters\Root\ColorAdapter;
use App\Contracts\Root\ImageContract;
use App\Models\Root\Image;
use Illuminate\Support\Facades\Cache;
use League\ColorExtractor\Palette;
use \App\Models\Root\Color;
use League\ColorExtractor\ColorExtractor;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'colors'
    ];
    protected $defaultIncludes = [
        'colors'
    ];

    public function transform(ImageContract $image)
    {
        return [
            'url' => $image->getUrl(),
            'width' => $image->getWidth(),
            'height' => $image->getHeight(),
        ];
    }

    public function includeColors(ImageContract $image)
    {
        $colorAdapters = $image->getColors()->transform(function ($color) {
            return new Color(new ColorAdapter($color));
        });

        return $this->collection($colorAdapters, new ColorTransformer());
    }
}
