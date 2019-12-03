<?php

namespace App\Transformers\Root;

use App\Models\Root\Color;
use League\Fractal\TransformerAbstract;

class ColorTransformer extends TransformerAbstract
{

    public function transform(Color $color)
    {
        return [
            'color' => $color->getHex(),
        ];
    }
}
