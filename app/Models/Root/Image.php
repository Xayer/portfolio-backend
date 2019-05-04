<?php

namespace App\Models\Root;

use App\Contracts\Root\ImageContract;

class Image implements ImageContract
{
    protected $image;

    public function __construct(ImageContract $image)
    {
        $this->image = $image;
    }

    public function getUrl(): ?string
    {
        return $this->image->getUrl();
    }

    public function getWidth(): ?int
    {
        return $this->image->getWidth();
    }

    public function getHeight(): ?int
    {
        return $this->image->getHeight();
    }
}

