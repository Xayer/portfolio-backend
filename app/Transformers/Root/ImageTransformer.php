<?php

namespace App\Transformers\Root;

use App\Contracts\Root\ImageContract;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{

    public function transform(ImageContract $image)
    {
        return [
            'url' => $image->getUrl()
        ];
    }
}
