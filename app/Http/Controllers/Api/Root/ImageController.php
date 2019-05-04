<?php

namespace App\Http\Controllers\Api\Root;

use App\Adapters\Root\ImageAdapter;
use App\Http\Controllers\Controller;
use App\Models\Root\Image;
use App\Transformers\Root\ImageTransformer;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function showImage($url, Request $request)
    {
        $image = new ImageAdapter($url);
        return Fractal($image, new ImageTransformer())->respond();
    }
}
